# Use the official Python slim image as the base
FROM python:3.9-slim

# Set the working directory inside the container
WORKDIR /app

# Copy your local file api.py into the container's /app directory
COPY api.py /app/
COPY sales_predictor.pkl /app/
COPY requirements.txt /app/

# Install system dependencies required by some libraries
RUN pip install --no-cache-dir -r requirements.txt

# Run your Python script
CMD ["python", "./api.py"]
