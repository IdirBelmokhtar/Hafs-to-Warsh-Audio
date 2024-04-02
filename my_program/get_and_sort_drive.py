import pandas as pd
import json
import re

name = "ibrahim_al_dossari"

# Function to extract the Google Drive ID from the URL
def extract_drive_id(url):
    match = re.search(r'/d/([^/]+)/', url)
    if match:
        return match.group(1)
    else:
        return None

# Read the Excel file
df = pd.read_excel('all links.xlsx')

# Create a dictionary to store the data
data = {}

# Iterate through the DataFrame rows
for index, row in df.iterrows():
    full_path = row['Full Path']
    url = row['URL']
    file_type = row['Type']

    # Split the full path into parts
    parts = full_path.split('/')
    
    # Initialize the dictionary with the root
    current_dict = data
    
    # Iterate through the parts of the path
    for part in parts:
        if part not in current_dict:
            # If the part does not exist in the current dictionary, add it
            current_dict[part] = {}
        # Update the current dictionary
        current_dict = current_dict[part]
    
    # If the file type is "Files", add the URL
    if file_type == 'Files':
        # Extract the Google Drive ID from the URL
        drive_id = extract_drive_id(url)
        if drive_id:
            # Build the desired URL with the Google Drive ID
            download_url = f"https://drive.google.com/uc?id={drive_id}&export=download"
            current_dict['URL'] = download_url

# Convert the dictionary to JSON
json_data = json.dumps(data, indent=4)

# Write the JSON to a file
with open('data_v1.json', 'w') as json_file:
    json_file.write(json_data)

# Load the JSON data from the file
with open('data_v1.json', 'r') as file:
    data = json.load(file)

# Function to remove hyphen from dictionary keys
def remove_hyphen_from_keys(d):
    keys_to_remove = []
    keys_to_add = {}
    
    # Identify keys to be modified
    for key in d.keys():
        if key.endswith("-"):
            new_key = key.rstrip("-")
            keys_to_remove.append(key)
            keys_to_add[new_key] = d[key]
    
    # Update dictionary keys
    for key in keys_to_remove:
        del d[key]
    for key, value in keys_to_add.items():
        d[key] = value
        
    # Recursively apply to nested dictionaries
    for key, value in d.items():
        if isinstance(value, dict):
            remove_hyphen_from_keys(value)
            
# Updating dictionary
remove_hyphen_from_keys(data[name])

# Write updated data back to JSON file
with open("data_v2.json", "w") as file:
    json.dump(data, file, indent=4)


# Load the JSON data from the file
with open('data_v2.json', 'r') as file:
    data = json.load(file)

# Sort the JSON data based on keys in descending order
def sorting_key(item):
    key = item[0]
    # Remove hyphens and empty strings from the key, then extract the first three characters
    key = key.replace('-', '').replace('', '')[:3]
    # Convert the key to an integer
    return int(key)

# Sorting and retaining the name key
sorted_data = {name: {}}

for key, value in sorted(data[name].items(), key=sorting_key):
    sorted_data[name][key] = dict(sorted(value.items()))

# Save the sorted data back to the file
with open('output.json', 'w') as file:
    json.dump(sorted_data, file, indent=4)

print("Data sorted and saved to output.json")
