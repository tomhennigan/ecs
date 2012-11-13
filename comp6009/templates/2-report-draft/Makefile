
TEXLIVE_ROOT := /usr/local/texlive/2010/bin/universal-darwin
LATEX := $(TEXLIVE_ROOT)/pdflatex
BIBTEX := $(TEXLIVE_ROOT)/bibtex

all:: draft.pdf

draft.pdf: draft.tex 
	$(LATEX) $<
	$(BIBTEX) draft
	$(LATEX) $<
	$(LATEX) $<
	
	
dist-clean::
	-rm -f draft.log draft.dvi draft.aux draft.toc draft.bbl draft.blg draft.out *.aux

open: draft.pdf
	open $<

clean::
	-rm -f draft.pdf

