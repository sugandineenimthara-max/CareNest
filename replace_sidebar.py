import os
import re

directory = r'c:\Users\mranj\OneDrive\Desktop\ashi-project\CareNest\resources\views'
pattern = re.compile(r'<aside class="sidebar">.*?</aside>', re.DOTALL)
replacement = "@include('partials.sidebar')"

count = 0
for root, dirs, files in os.walk(directory):
    for file in files:
        if file.endswith('.blade.php') and file != 'sidebar.blade.php':
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            if pattern.search(content):
                new_content = pattern.sub(replacement, content)
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                count += 1
                print(f"Replaced sidebar in {filepath}")

print(f"Total files updated: {count}")
