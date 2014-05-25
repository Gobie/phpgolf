# Size
134 bytes

# Observation
Sequences are always multiples of 2, which means we have last bit free for use. Let's store newline there, as "&1" is shorter then "&128".

# Implementation
Compression takes ' ', '@' and sets 2nd bit to differentiate char, bits 3-7 are then used for storing number of repeating characters