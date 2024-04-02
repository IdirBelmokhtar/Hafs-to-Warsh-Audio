import os

# Chemin du dossier racine contenant les sous-dossiers numérotés de 1 à 114
dossier_racine = os.path.join(os.path.dirname(__file__), 'All')

# Fonction récursive pour renommer les dossiers et les fichiers
def renommer_dossiers_et_fichiers(dossier_parent):
    # Parcours de tous les éléments (dossiers et fichiers) dans le dossier parent
    for element in os.listdir(dossier_parent):
        chemin_element = os.path.join(dossier_parent, element)
        # Si c'est un dossier, on le renomme et on le parcourt récursivement
        if os.path.isdir(chemin_element):
            # Renommer le dossier
            nouveau_nom_dossier = "{:03d}".format(int(element))
            nouvel_chemin_dossier = os.path.join(dossier_parent, nouveau_nom_dossier)
            os.rename(chemin_element, nouvel_chemin_dossier)
            # Appel récursif pour parcourir le sous-dossier
            renommer_dossiers_et_fichiers(nouvel_chemin_dossier)
        # Si c'est un fichier MP3, on le renomme
        elif element.endswith('.mp3'):
            # Renommer le fichier
            nom_fichier, extension = os.path.splitext(element)
            nouveau_nom_fichier = "{:03d}{}".format(int(nom_fichier), extension)
            nouvel_chemin_fichier = os.path.join(dossier_parent, nouveau_nom_fichier)
            os.rename(chemin_element, nouvel_chemin_fichier)

# Appel de la fonction pour renommer les dossiers et les fichiers à partir du dossier racine
renommer_dossiers_et_fichiers(dossier_racine)

print("Tous les dossiers et fichiers ont été renommés avec succès.")
