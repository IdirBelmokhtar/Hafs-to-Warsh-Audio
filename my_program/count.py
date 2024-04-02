import json

# Charger le fichier JSON
with open('output.json') as f:
    data = json.load(f)

# Initialiser le compteur de liens
nombre_de_liens = 0

# Parcourir chaque élément dans la structure JSON
for key, value in data['translate_kabyle_voix'].items():
    for sub_key, sub_value in value.items():
        nombre_de_liens += len(sub_value)

# Afficher le nombre total de liens
print("Nombre total de liens :", nombre_de_liens)
