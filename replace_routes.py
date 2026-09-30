import os
import re

directory = r'c:\Users\mranj\OneDrive\Desktop\ashi-project\CareNest\resources\views'
pattern1 = re.compile(r"route\('mothers\.")
replacement1 = "route((auth()->user()->role === 'midwife' ? 'midwife.' : (auth()->user()->role === 'mother' ? 'mother.' : 'admin.')) . 'mothers."

pattern2 = re.compile(r"route\('children\.")
replacement2 = "route((auth()->user()->role === 'midwife' ? 'midwife.' : (auth()->user()->role === 'mother' ? 'mother.' : 'admin.')) . 'children."

pattern3 = re.compile(r"route\('immunizations\.")
replacement3 = "route((auth()->user()->role === 'midwife' ? 'midwife.' : (auth()->user()->role === 'mother' ? 'mother.' : 'admin.')) . 'immunizations."

pattern4 = re.compile(r"route\('alerts\.")
replacement4 = "route((auth()->user()->role === 'midwife' ? 'midwife.' : (auth()->user()->role === 'mother' ? 'mother.' : 'admin.')) . 'alerts."

# Also replace route('dashboard') with route('dashboard') since we have a generic dashboard route in web.php
# Actually route('dashboard') is still valid and redirects.

count = 0
for root, dirs, files in os.walk(directory):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            new_content = pattern1.sub(replacement1, content)
            new_content = pattern2.sub(replacement2, new_content)
            new_content = pattern3.sub(replacement3, new_content)
            new_content = pattern4.sub(replacement4, new_content)
            
            if new_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                count += 1
                print(f"Replaced routes in {filepath}")

print(f"Total files updated: {count}")
