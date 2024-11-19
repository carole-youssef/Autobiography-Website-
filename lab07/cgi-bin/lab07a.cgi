#!/usr/bin/perl -wT
use CGI ':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);

print "Content-Type: text/html\n\n";

print qq(<!DOCTYPE html>);
print qq(<html>);
print qq(<head>);
print qq(
	<title>Lab07 Part A</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sour+Gummy&display=swap" rel="stylesheet">
    <style>
        p {
            text-align: center;
            font-size: 80px;
            color: red;
            margin: 0;
            font-family: 'Sour Gummy', serif;
        }
    </style>
);
print qq(</head>);
print qq(<body>);
print qq(<p>This is my first Perl program</p>);
print qq(</body>);
print qq(</html>);


