
TEXLIVE_ROOT := /usr/local/texlive/2010/bin/universal-darwin
LATEX := $(TEXLIVE_ROOT)/pdflatex

all:: reflective-summary.pdf

reflective-summary.pdf: reflective-summary.tex Makefile
	$(LATEX) $<
	$(LATEX) $<
	$(LATEX) $<
	rm -f reflective-summary.log reflective-summary.aux reflective-summary.out

clean::
	-rm -f reflective-summary.pdf

open: reflective-summary.pdf
	open $<
