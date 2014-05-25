# Size
35 bytes

# Observation
What about using ~ as negation of strings, it helps a lot

# Implementation
It helps in regex, but ~ß is space and that will break the code as parser tokenizes on whitespace characters.
After a bit of research, I found out I don't really need 'ß' (11011111), '_' (1011111) is enough.