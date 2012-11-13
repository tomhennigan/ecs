
TEXLIVE_ROOT := /usr/local/texlive/2008/bin/universal-darwin
LATEX := $(TEXLIVE_ROOT)/latex
DVIPDF := $(TEXLIVE_ROOT)/dvipdfm
BIBTEX := $(TEXLIVE_ROOT)/bibtex

all:: litsearch.pdf

litsearch.pdf: litsearch.tex 
	export PATH="$PATH:$(TEXLIVE_ROOT)"
	$(LATEX) litsearch.tex
	$(BIBTEX) litsearch
	$(LATEX) litsearch.tex
	$(LATEX) litsearch.tex
	$(LATEX) litsearch.tex
	$(DVIPDF) litsearch.dvi
	@make dist-clean

open: litsearch.pdf
	open $<

dist-clean:
	-rm -f litsearch.log litsearch.dvi litsearch.aux litsearch.toc bu.aux litsearch.bbl litsearch.blg

clean:
	-rm -f litsearch.pdf
