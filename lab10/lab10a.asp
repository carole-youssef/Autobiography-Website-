<%
dim bgcolour
bgcolour = Request.QueryString("bgcolour")

if bgcolour = "" then
    bgcolour = "#ffffff" ' Default to white if no query string is provided
end if

dim bgcolourstyle
bgcolourstyle = "background-color: " & bgcolour & ";"

dim currentTime, adjustedTime
currentTime = Now()
adjustedTime = DateAdd("h", +1, currentTime) ' changing to proper canadian time

dim lastVisit
lastVisit = Request.Cookies("LastVisit")

if lastVisit = "" then
    Response.Cookies("LastVisit") = adjustedTime
    Response.Cookies("LastVisit").Expires = DateAdd("m", 1, currentTime) ' Cookie expires in 1 month
    lastVisit = "This is your first visit!"
else
    lastVisit = "Welcome back! Your last visit was on " & lastVisit
    Response.Cookies("LastVisit") = adjustedTime
    Response.Cookies("LastVisit").Expires = DateAdd("m", 1, currentTime)
end if
%>

<!DOCTYPE html>
<html>
<head>
    <title>Lab10a: ASP</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            <%= bgcolourstyle %>
        }
    </style>
</head>
<body>
    <h1>Welcome!</h1>
    <p>Enter a colour in the URL to display as the background.</p>
    <p>Add ?bgcolour=colourName OR ?bgcolour=%23hexCode at the end of the URL</p>
    <br>
    <h3><%= lastVisit %></h3>
</body>
</html>
