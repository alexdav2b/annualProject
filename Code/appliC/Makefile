# Declaration of variables
CC = gcc
CC_FLAGS = -Wall -Wextra -Wno-unused-parameter
LIBS_FLAGS = -lcurl -ljansson  #$$(pkg-config --cflags --libs jansson libcurl)

# File names
EXEC = tmp
SOURCES =	$(wildcard *.c) \
			 $(wildcard */*.c)
OBJECTS = $(SOURCES:.c=.o)

# Main target
$(EXEC): $(OBJECTS)
	$(CC) $(OBJECTS) $(LIBS_FLAGS) -o $(EXEC)

# To obtain object files
%.o: %.c
	$(CC) -c $(CC_FLAGS) $(LIBS_FLAGS) $< -o $@

# To remove generated files
.PHONY: clean
clean:
	rm	-f $(EXEC) $(OBJECTS)

cleanObj:
	rm -f $(OBJECTS)

#construct all and clean obj
build:
	make && make cleanObj && ./tmp