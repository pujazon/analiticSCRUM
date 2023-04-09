#Object files shouldn't be on the repository. 
#They must be compilated on time
.PHONY: all

CC=g++
SRC=./../src/
LIBS=./../libs/
OBJS=./objs/
BIN=../exe/

#TODO: setup shouldn't be done in a explicit build, should be a generic rule pe: *.

all: main.o
	$(CC) -o $(BIN)analiticSCRUM.out $(OBJS)main.o

#TODO: Download glibc if not present

setup: 
	mkdir $(OBJS)
	mkdir $(BIN)
	mkdir $(LIBS)

main.o:
	$(CC) -c $(SRC)main.cpp
	mv main.o $(OBJS)

clean:	
	if [ -d "$(OBJS)" ]; then rm -r $(OBJS); fi
	if [ -d "$(BIN)" ]; then rm -r $(BIN); fi

clean_all: clean
	if [ -d "$(LIBS)" ]; then rm -r $(LIBS); fi
