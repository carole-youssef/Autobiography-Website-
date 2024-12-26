#!/usr/bin/env ruby

require "cgi"
require "cgi/util"

cgi = CGI.new

# Retrieve form data
city = cgi['city'].strip.capitalize #getting for values in ruby and making words capitalized
province = cgi['province'].strip.capitalize
country = cgi['country'].strip.capitalize
photo = cgi['photo'].strip

# Generate HTML response
cgi.out("type" => "text/html", "charset" => "UTF-8") do
  <<~HTML
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <title>#{CGI.escapeHTML(city)}, #{CGI.escapeHTML(country)}</title>
        <style>
          body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #C2EDEF;
            text-align: center;
          }
          .location {
            margin: 3rem 0;
            font-size: 4rem;
            color: #0097a7; 
          }
          .province {
            margin: 1.5rem 0;
            font-size: 2rem;
            color: #0097a7;
          }
          .image-container img {
            width: 100%;
            height: auto;
            display: block;
          }
        </style>
      </head>
      <body>
        <div class="content">
          <h1 class="location">
            #{CGI.escapeHTML(city)}, #{CGI.escapeHTML(country)}
          </h1>
          #{
            if !province.nil? && !province.empty?
              "<h2 class='province'>Province/State: #{CGI.escapeHTML(province)}</h2>"
            else
              ""
            end
          }
          <div class="image-container">
            <img src="#{CGI.escapeHTML(photo)}" alt="Image of #{CGI.escapeHTML(city)}">
          </div>
        </div>
      </body>
    </html>
  HTML
end





