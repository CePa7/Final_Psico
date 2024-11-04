import joblib
import json
import sys

# Cargar el modelo
model = joblib.load('storage/app/models/modelo_citas.pkl')

# Leer los datos desde el archivo temporal
with open(sys.argv[1]) as f:
    data = json.load(f)

# Asegúrate de que tus datos están en el formato correcto
# Realiza la predicción
prediction = model.predict([list(data.values())])  # Ajusta según tu modelo

# Imprimir la predicción
print(prediction[0])
