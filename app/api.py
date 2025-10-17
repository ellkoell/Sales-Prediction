from flask import Flask, request, jsonify
import joblib  # or import pickle
import pandas as pd
from flask_cors import CORS 


app = Flask(__name__)
CORS(app)

# Load the model
model = joblib.load("sales_predictor.pkl") 

@app.route("/predict", methods=["POST"])
def predict():
    # Get the JSON data from the request
    data = request.get_json()
    
    # Extract day and month from the request
    tv = data.get("tv")
    radio = data.get("radio")
    newspaper = data.get("newspaper")


    # Prepare the data for prediction
    input_data = pd.DataFrame({"TV": [tv], "Radio": [radio], "Newspaper": [newspaper]})
    
    # Make the prediction
    prediction = model.predict(input_data)
    
    # Return the prediction as JSON
    return jsonify({"predicted_sales": prediction[0]})

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000, debug=True)
    #app.run(debug=True)

# docker build -t salespredcontainer .