<?php

namespace App\Classes;

use Dusterio\LinkPreview\Client;
use Dusterio\LinkPreview\Exceptions\ConnectionErrorException;
use GuzzleHttp\Exception\ClientException;
use ValueError;

/**
 * Get An Image and Title Preview of Link
 */
class LinkPreview
{
    /**
     * Link to generate preview for
     *
     * @var string
     */
    private string $link;

    /**
     * Link preview image
     *
     * @var string|null
     */
    private ?string $previewImage;

    /**
     * Link preview text
     *
     * @var string|null
     */
    private ?string $text;

    private const FALLBACK_IMAGE = 'id=link-icon-theme';

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Static constructor
     *
     * @param string|null $link
     * @return static
     */
    public static function create(?string $link = ''): static
    {
        return new self($link ?? '');
    }

    /**
     * Create a preview with existing data
     *
     * @param string $image
     * @param string $text
     * @return static
     */
    public function withExisting(string $image, string $text): static
    {
        $this->previewImage =
            $image == 'style=background-image:url();' ? null : $image;
        $this->text = $text;
        return $this;
    }

    /**
     * Create a preview with fetched data
     * @return static
     */
    public function withoutExisting(): static
    {
        $this->updatePreview($this->link);
        return $this;
    }

    /**
     * Return error on validation failure
     * @return static
     */
    public function withError(): static
    {
        $this->previewImage = null;
        $this->text = 'Invalid URL';
        return $this;
    }

    /**
     * Update preview with new link
     * @param  string $link
     * @return static
     */
    public function updatePreview(string $link): static
    {
        if (
            !isset($link) ||
            (substr($link, 0, 7) != 'http://' &&
                substr($link, 0, 8) != 'https://') ||
            strlen($link) <= 9 ||
            str_contains($link, ' ')
        ) {
            $this->previewImage = null;
            $this->text = null;
            return $this;
        }

        $client = new Client($link);
        $client
            ->getParser('general')
            ->getReader()
            ->config([
                'connect_timeout' => 2,
                'allow_redirects' => ['max' => 5],
            ]);

        try {
            $preview = $client->getPreview('general');
            $this->link = $link;

            $preview = $preview->toArray();
            $this->text = $preview['title'];
            $this->previewImage = !@get_headers($preview['cover'])
                ? null
                : 'style=background-image:url(' . $preview['cover'] . ');';
        } catch (ConnectionErrorException | ClientException) {
            $this->text = null;
        } catch (ValueError) {
            $this->previewImage = null;
        }
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getPreview(): string
    {
        return $this->previewImage ?? self::FALLBACK_IMAGE;
    }

    public function getText(): string
    {
        return $this->text ?? 'Unable to Load Preview';
    }
}
