<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class UniversityBacklinkService
{
    private const TARGET_URL = 'https://uinsgd.ac.id';

    private const PHRASE_PATTERN = '/(?<![\p{L}\p{N}_])(?:UIN\s+Sunan\s+Gunung\s+Djati\s+Bandung|UIN\s+Bandung|UIN)(?![\p{L}\p{N}_])/iu';

    public function linkify(string $html): string
    {
        if ($html === '') {
            return $html;
        }

        $rootId = 'university-backlink-' . bin2hex(random_bytes(8));
        $document = new DOMDocument('1.0', 'UTF-8');
        $previousErrorMode = libxml_use_internal_errors(true);

        try {
            $loaded = $document->loadHTML(
                '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body><div id="' . $rootId . '">' . $html . '</div></body></html>',
                LIBXML_NONET | LIBXML_HTML_NODEFDTD,
            );

            if (! $loaded) {
                return $html;
            }

            $xpath = new DOMXPath($document);
            $root = $xpath->query('//*[@id="' . $rootId . '"]')->item(0);

            if (! $root instanceof DOMElement) {
                return $html;
            }

            $textNodes = [];

            foreach ($xpath->query(
                '//*[@id="' . $rootId . '"]//text()[not(ancestor::a or ancestor::code or ancestor::pre or ancestor::script or ancestor::style or ancestor::textarea)]',
            ) as $textNode) {
                $textNodes[] = $textNode;
            }

            foreach ($textNodes as $textNode) {
                $this->linkifyTextNode($document, $textNode);
            }

            $output = '';

            foreach ($root->childNodes as $child) {
                $output .= $document->saveHTML($child);
            }

            return $output;
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorMode);
        }
    }

    private function linkifyTextNode(DOMDocument $document, DOMNode $textNode): void
    {
        $text = $textNode->nodeValue ?? '';
        $matchCount = preg_match_all(self::PHRASE_PATTERN, $text, $matches, PREG_OFFSET_CAPTURE);

        if (! $matchCount) {
            return;
        }

        $fragment = $document->createDocumentFragment();
        $offset = 0;

        foreach ($matches[0] as [$phrase, $position]) {
            if ($position > $offset) {
                $fragment->appendChild($document->createTextNode(substr($text, $offset, $position - $offset)));
            }

            $link = $document->createElement('a');
            $link->setAttribute('href', self::TARGET_URL);
            $link->appendChild($document->createTextNode($phrase));
            $fragment->appendChild($link);
            $offset = $position + strlen($phrase);
        }

        if ($offset < strlen($text)) {
            $fragment->appendChild($document->createTextNode(substr($text, $offset)));
        }

        $textNode->parentNode?->replaceChild($fragment, $textNode);
    }
}
