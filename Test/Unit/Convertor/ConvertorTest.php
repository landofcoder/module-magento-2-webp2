<?php declare(strict_types=1);

namespace Lof\Webp2\Test\Unit\Convertor;

use Magento\Framework\Filesystem\Driver\File as FileDriver;
use Magento\Framework\Filesystem\File\Read;
use Magento\Framework\Filesystem\File\ReadFactory;
use PHPUnit\Framework\TestCase;
use Lof\NextGenImages\Exception\ConvertorException;
use Lof\NextGenImages\Image\File;
use Lof\NextGenImages\Image\SourceImageFactory;
use Lof\NextGenImages\Logger\Debugger;
use Lof\Webp2\Config\Config;
use Lof\Webp2\Convertor\Convertor;
use Lof\Webp2\Image\ConvertWrapper;

class ConvertorTest extends TestCase
{
    /**
     * Test for Lof\Webp2\Convertor\Convertor::getSourceImage
     */
    public function testGetSourceImage()
    {
        $config = $this->createMock(Config::class);
        $config->method('enabled')->willReturn(true);
        $convertor = $this->getConvertor($config);

        $this->expectException(ConvertorException::class);
        $this->assertEquals('/test/foobar.webp', $convertor->getSourceImage('/test/foobar.jpg'));
    }

    /**
     * Test for Lof\Webp2\Convertor\Convertor::convert
     */
    public function testConvert()
    {
        $convertor = $this->getConvertor();
        $this->assertFalse($convertor->convert('/images/test.jpg', '/images/test.webp'));
    }

    /**
     * Test for Lof\Webp2\Convertor\Convertor::urlExists
     */
    public function testUrlExists()
    {
        $convertor = $this->getConvertor();
        $this->assertFalse($convertor->urlExists('http://localhost/test.webp'));
    }

    /**
     * @param Config|null $config
     * @return Convertor
     */
    private function getConvertor(?Config $config = null): Convertor
    {
        if (!$config) {
            $config = $this->createMock(Config::class);
        }

        $sourceImageFactory = $this->createMock(SourceImageFactory::class);
        $file = $this->createMock(File::class);
        $convertWrapper = $this->createMock(ConvertWrapper::class);
        $fileReadFactory = $this->getFileReadFactory();
        $debugger = $this->createMock(Debugger::class);
        $fileDriver = $this->createMock(FileDriver::class);

        return new Convertor(
            $config,
            $sourceImageFactory,
            $file,
            $convertWrapper,
            $fileReadFactory,
            $debugger,
            $fileDriver
        );
    }

    /**
     * @return ReadFactory
     */
    private function getFileReadFactory(): ReadFactory
    {
        $fileRead = $this->createMock(Read::class);
        $fileReadFactory = $this->createMock(ReadFactory::class);
        $fileReadFactory->method('create')->willReturn($fileRead);
        return $fileReadFactory;
    }
}
