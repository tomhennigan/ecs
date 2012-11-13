
TEXROOT := /usr/local/texlive/2010/bin/universal-darwin
LATEX := $(TEXROOT)/latex
DVIPDF := PATH="${PATH}:$(TEXROOT)" /usr/local/bin/dvipdf
BIBTEX := $(TEXROOT)/bibtex

all:: Proposal.pdf

Proposal.pdf: Proposal.tex
	$(LATEX) Proposal.tex
	# $(BIBTEX) Proposal # For the references.
    # $(LATEX) Proposal.tex
    # $(LATEX) Proposal.tex
	$(DVIPDF) Proposal.dvi
	@make dist-clean

open: Proposal.pdf
	open $<

dist-clean:
	-rm -f Proposal.log Proposal.dvi Proposal.aux Proposal.toc

clean:
	-rm -f Proposal.pdf
