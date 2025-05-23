<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    protected ?string $phoneNumberId;
    protected ?string $accessToken;
    protected string $baseUrl = 'https://graph.facebook.com';

    public function __construct()
    {
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
        $this->accessToken   = config('services.whatsapp.access_token');

        if (empty($this->phoneNumberId)) {
            throw new \Exception("WA_PHONE_NUMBER_ID belum diset di .env atau config/services.php");
        }

        if (empty($this->accessToken)) {
            throw new \Exception("WA_ACCESS_TOKEN belum diset di .env atau config/services.php");
        }
    }

    /**
     * Kirim pesan teks biasa via WhatsApp.
     *
     * @param string $to Nomor tujuan E.164 tanpa tanda +
     * @param string $body Isi pesan
     * @return array Response JSON dari API
     */
    public function sendText(string $to, string $body): array
    {
        $to = ltrim($to, '+');
        $url = "{$this->baseUrl}/v15.0/{$this->phoneNumberId}/messages";

        $payload = [
            'messaging_product' => 'whatsapp',
            'to'                => $to,
            'type'              => 'text',
            'text'              => ['body' => $body],
        ];

        return Http::withToken($this->accessToken)
                   ->post($url, $payload)
                   ->throw()
                   ->json();
    }

    /**
     * Kirim pesan template WhatsApp.
     *
     * @param string $to Nomor tujuan E.164 tanpa tanda +
     * @param string $templateName Nama template yang sudah disetujui di Meta
     * @param string $languageCode Kode bahasa template (misal: "en")
     * @param array $components Komponen parameter template sesuai dokumentasi Meta
     * @return array Response JSON dari API
     */
    public function sendTemplate(string $to, string $templateName, string $languageCode, array $components): array
    {
        $to = ltrim($to, '+');
        $url = "{$this->baseUrl}/v15.0/{$this->phoneNumberId}/messages";

        $payload = [
            'messaging_product' => 'whatsapp',
            'to'                => $to,
            'type'              => 'template',
            'template'          => [
                'name'       => $templateName,
                'language'   => ['code' => $languageCode],
                'components' => $components,
            ],
        ];

        return Http::withToken($this->accessToken)
                   ->post($url, $payload)
                   ->throw()
                   ->json();
    }
}
