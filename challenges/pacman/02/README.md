# Size
163 bytes

# Observation
We have only alphabet with 3 chars " ", "@", "\n" and reasonably short sequences, let's encode it in one byte.

# Implementation
Compression takes ' ' or '@' and sets 1st bit to differentiate char, rest of the byte is then used for storing number of repeating characters
newline is left as it is and is treated separately in decompression.