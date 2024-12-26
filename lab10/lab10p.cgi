#!/usr/bin/env python3

import cgi
import html

# Read form data
form = cgi.FieldStorage()
city = form.getvalue('city', '').strip().upper() #how to get form values in python
province = form.getvalue('province', '').strip().upper() #making it all upper case
country = form.getvalue('country', '').strip().upper()
photo = form.getvalue('photo', '').strip()

# HTML output
print("Content-type: text/html\n")
print(f"""
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{html.escape(city)}, {html.escape(country)}</title>
    <style>
      body, html {{
         margin: 0;
         padding: 0;
         font-family: 'Arial', sans-serif;
         background-color: #EED1ED;
         text-align: center;
      }}
      .location {{
        margin: 3rem 0;
        font-size: 4rem;
		color: #A43FA2;
      }}
      .province {{
        margin: 2rem 0;
        font-size: 2rem;
        color: #A43FA2;
      }}
      .image-container {{
        margin: 1.5rem auto;
        width: 80%;
        border: 15px solid #EF4EC8;
        overflow: hidden;
      }}
      .image-container img {{
        width: 100%;
        height: auto;
        display: block;
      }}
    </style>
  </head>
  <body>
    <div class="content">
      <h1 class="location">{html.escape(city)}, {html.escape(country)}</h1>
      {f'<h2 class="province">PROVINCE/STATE: {html.escape(province)}</h2>' if province else ''} 
      <div class="image-container">
        <img src="{html.escape(photo)}" alt="Image of {html.escape(city)}">
      </div>
    </div>
  </body>
</html>
""")


