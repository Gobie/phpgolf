# Size
153 bytes

# Observation
Max sequence is 36 chars, which means last 6 bits is enough for encoding sequence length, we can use first 2 bits for differentiating chars.

# Implementation
Compression takes ' ', '@' or "\n" and sets first 2 bits to differentiate char, rest of the byte is then used for storing number of repeating characters