import mysql.connector
import json
import os
import requests
import zipfile
from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware  # Import CORSMiddleware
from fastapi.responses import FileResponse
from PIL import Image, ImageDraw, ImageFont

# -------------------------------
# Database configuration
# -------------------------------
db_config = {
    "host": "127.0.0.1",
    "port": 3306,
    "user": "root",
    "password": "Farique@123",
    "database": "sertiphy"
}

def get_unique_cert_name(folder_path, extension="png"):
    """Generate a unique cert name with incrementing number."""
    counter = 1
    while True:
        cert_name = f"cert_{counter}.{extension}"
        cert_path = os.path.join(folder_path, cert_name)
        if not os.path.exists(cert_path):
            return cert_path
        counter += 1

# -------------------------------
# FastAPI initialization
# -------------------------------
app = FastAPI()

# -------------------------------
# CORS Middleware Configuration
# -------------------------------
origins = [
    "http://127.0.0.1:8000",  # Allow your Laravel app's origin
    "http://localhost:8000",  # Optional: If you're testing on localhost
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,  # List of allowed origins
    allow_credentials=True,  # Allow cookies and credentials
    allow_methods=["GET", "POST", "PUT", "DELETE"],  # Allowed HTTP methods
    allow_headers=["*"],  # Allow all headers
)

# Base folder for generated files
BASE_FOLDER = "project"

# Create project folder if it doesn’t exist
if not os.path.exists(BASE_FOLDER):
    os.makedirs(BASE_FOLDER)

# -------------------------------
# API Endpoint to Generate Certificates
# -------------------------------
@app.get("/generate-certificates/{project_id}")
async def generate_certificates(project_id: int):
    try:
        # Connect to MySQL database
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()

        # -------------------------------
        # Get fieldDescription from fieldproperties
        # -------------------------------
        query_fieldproperties = "SELECT project_id, fieldDescription, field_properties FROM fieldproperties WHERE project_id = %s"
        cursor.execute(query_fieldproperties, (project_id,))

        field_properties_dict = {}
        image_path = None

        # Loop through rows and extract field data
        for row in cursor.fetchall():
            field_description = row[1]
            field_properties_json = row[2]

            try:
                # Parse JSON data for field properties
                field_properties = json.loads(field_properties_json)

                # Check if fieldDescription contains 'image'
                if "image" in field_description.lower() and "url" in field_properties:
                    image_url = field_properties["url"]

                    # Get image extension and name by project_id
                    image_extension = image_url.split(".")[-1]
                    image_name = f"{project_id}_image.{image_extension}"
                    image_path = os.path.join(BASE_FOLDER, image_name)

                    # Download and save the image
                    response = requests.get(image_url)
                    if response.status_code == 200:
                        with open(image_path, "wb") as img_file:
                            img_file.write(response.content)
                        print(f"✅ Image downloaded: {image_path}\n")
                    else:
                        raise HTTPException(status_code=400, detail=f"Failed to download image from {image_url}")
                else:
                    # Store field properties for later use
                    field_properties_dict[field_description] = field_properties

            except json.JSONDecodeError as e:
                raise HTTPException(status_code=500, detail=f"Error decoding JSON in fieldproperties: {e}")

        # -------------------------------
        # Get fieldData from exceluploaddata
        # -------------------------------
        query_exceluploaddata = "SELECT fieldData FROM exceluploaddata WHERE project_id = %s"
        cursor.execute(query_exceluploaddata, (project_id,))

        # Load base certificate image
        if image_path and os.path.exists(image_path):
            base_image = Image.open(image_path)
        else:
            raise HTTPException(status_code=404, detail="Certificate image not found.")

        # -------------------------------
        # Generate Certificates
        # -------------------------------
        certificates_list = []
        zip_filename = os.path.join(BASE_FOLDER, f"{project_id}_certificates.zip")

        for row in cursor.fetchall():
            fielddata_json = row[0]
            try:
                # Parse field data JSON
                fielddata_dict = json.loads(fielddata_json)

                # Create a copy of the base image
                cert_image = base_image.copy()
                draw = ImageDraw.Draw(cert_image)

                # Draw text for each fieldDescription
                for field_description, field_properties in field_properties_dict.items():
                    if field_description in fielddata_dict:
                        field_value = str(fielddata_dict[field_description])

                        # Get properties
                        x = int(field_properties.get("x", 0))
                        y = int(field_properties.get("y", 0))
                        font_size = int(field_properties.get("fontSize", 24))
                        font_color = field_properties.get("fontColor", "#000000")
                        font_style = field_properties.get("fontStyle", "arial.ttf")

                        # Font path (default to arial.ttf if custom font not available)
                        font_path = os.path.join("fonts", font_style)
                        if not os.path.exists(font_path):
                            font_path = "arial.ttf"

                        # Load font
                        try:
                            font = ImageFont.truetype(font_path, font_size)
                        except IOError:
                            font = ImageFont.load_default()

                        # Draw text on the image
                        draw.text((x, y), field_value, font=font, fill=font_color)

                # ---------------------------
                # Save Generated Certificate
                # ---------------------------

                # Generate a unique cert name like cert_1.png, cert_2.png, etc.
                cert_path = get_unique_cert_name(BASE_FOLDER)

                # Save the certificate
                cert_image.save(cert_path)
                certificates_list.append(cert_path)
                print(f"🎉 Certificate generated: {cert_path}")

            except json.JSONDecodeError as e:
                raise HTTPException(status_code=500, detail=f"Error decoding JSON in exceluploaddata: {e}")

        # -------------------------------
        # Create ZIP File for Certificates
        # -------------------------------
        with zipfile.ZipFile(zip_filename, "w") as zipf:
            for cert_file in certificates_list:
                zipf.write(cert_file, os.path.basename(cert_file))
                os.remove(cert_file)  # Cleanup individual certificate after adding to ZIP

        print(f"✅ All certificates zipped successfully: {zip_filename}")

        # -------------------------------
        # Return Download Link
        # -------------------------------
        return {f"/download/{project_id}"}

    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error: {str(e)}")

    finally:
        # Close database connection
        cursor.close()
        conn.close()

# -------------------------------
# Endpoint to Download Zip File
# -------------------------------
@app.get("/download/{project_id}")
async def download_zip(project_id: int):
    zip_filename = os.path.join(BASE_FOLDER, f"{project_id}_certificates.zip")

    if os.path.exists(zip_filename):
        return FileResponse(zip_filename, media_type="application/zip", filename=f"{project_id}_certificates.zip")
    else:
        raise HTTPException(status_code=404, detail="Zip file not found.")