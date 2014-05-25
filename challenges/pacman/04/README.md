# Size
136 bytes

# Observation
Removing newline from compressed data makes decompression longer so let's store it in character sequence just before newline as there is 1st bit free

# Implementation
Compression takes ' ', '@' and sets 2nd bit to differentiate char, rest of the byte is then used for storing number of repeating characters