
TEXLIVE_ROOT := /usr/local/texlive/2010/bin/universal-darwin
LATEX := $(TEXLIVE_ROOT)/pdflatex

all:: review.pdf

review.pdf: review.tex Makefile
	$(LATEX) $<
	$(LATEX) $<
	$(LATEX) $<
	rm -f review.log review.aux review.out

clean::
	-rm -f review.pdf

open: review.pdf
	open $<
