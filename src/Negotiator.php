<?php
declare(strict_types=1);

namespace Press\Utils;


class Negotiator
{

    public $request;


    public function __construct($request)
    {
        $this->request = $request;
    }


    public function charsets($available = null)
    {
        $accept_charset = array_key_exists('accept-charset', $this->request->headers) ?
            $this->request->headers['accept-charset'] : '';

        if (is_array($accept_charset)) {
            $accept_charset = join('', $accept_charset);
        }

        $accept_charset = $accept_charset === '' ? '' : $accept_charset;
        return Charset::preferredCharsets($accept_charset, $available);
    }


    public function charset($available = null)
    {
        $set = $this->charsets($available);
        return empty($set) ? null : $set[0];
    }


    public function encoding($available = null)
    {
        $set = $this->encodings($available);
        return empty($set) ? null : $set[0];
    }


    public function encodings($available = null)
    {
        $accept_encoding = array_key_exists('accept-encoding', $this->request->headers) ?
            $this->request->headers['accept-encoding'] : '';

        if (is_array($accept_encoding)) {
            $accept_encoding = join('', $accept_encoding);
        }

        $accept_encoding = $accept_encoding === '' ? '' : $accept_encoding;
        return Encoding::preferredEncodings($accept_encoding, $available);
    }


    public function language($available = null)
    {
        $set = $this->languages($available);
        return empty($set) ? null : $set[0];
    }


    public function languages($available = null)
    {
        $accept_language = array_key_exists('accept-language', $this->request->headers) ?
            $this->request->headers['accept-language'] : '';

        if (is_array($accept_language)) {
            $accept_language = join('', $accept_language);
        }

        $accept_language = $accept_language === '' ? '' : $accept_language;
        return Language::preferredLanguage($accept_language, $available);
    }


    public function mediaType($available = null)
    {
        $set = $this->mediaTypes($available);
        return empty($set) ? null : $set[0];
    }


    public function mediaTypes($available = null)
    {
        $accept_media_type = array_key_exists('accept', $this->request->headers) ?
            $this->request->headers['accept'] : '';

        if (is_array($accept_media_type)) {
            $accept_media_type = join('', $accept_media_type);
        }

        $accept_media_type = $accept_media_type === '' ? '' : $accept_media_type;

        return MediaType::preferredMediaTypes($accept_media_type, $available);
    }
}