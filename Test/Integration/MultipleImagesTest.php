<?php
declare(strict_types=1);

namespace Lof\Webp2\Test\Integration;

class MultipleImagesTest extends Common
{
    /**
     * @magentoAdminConfigFixture lof_webp2/settings/enabled 1
     * @magentoAdminConfigFixture lof_webp2/settings/debug 1
     */
    public function testIfHtmlContainsWebpImages(): void
    {
        $this->fixtureImageFiles();

        $this->getRequest()->setParam('case', 'multiple_images');
        $this->dispatch('webp/test/images');
        $this->assertSame('multiple_images', $this->getRequest()->getParam('case'));
        $this->assertSame(200, $this->getResponse()->getHttpResponseCode());

        $body = $this->getResponse()->getBody();
        $this->assertTrue((bool)strpos($body, 'type="image/webp"'));

        if (!getenv('TRAVIS')) {
            $this->assertImageTagsExist($body, $this->getImageProvider()->getImages());
        }
    }
}
