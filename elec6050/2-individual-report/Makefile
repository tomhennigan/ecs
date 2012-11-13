
TEXLIVE_ROOT := /usr/local/texlive/2008/bin/universal-darwin
LATEX := $(TEXLIVE_ROOT)/xelatex

all:: template
template: template.pdf
template.pdf: template.tex 
	$(LATEX) $<
	$(LATEX) $<
	$(LATEX) $<
	rm -f template.log template.dvi template.aux template.toc template.bbl template.blg template.out
	open template.pdf

clean:
	-rm -f template.pdf

