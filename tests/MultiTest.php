<?php
namespace vipnytt\XRobotsTagParser\Tests;

use vipnytt\XRobotsTagParser;

/**
 * Class MultiTest
 *
 * @package vipnytt\XRobotsTagParser\Tests
 */
class MultiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider generateDataForTest
     * @param string $userAgent
     * @param array $headers
     */
    public function testMultipleDirectives($userAgent, $headers)
    {
        $parser = new XRobotsTagParser\Adapters\TextString($headers, $userAgent);
        $this->assertInstanceOf('vipnytt\XRobotsTagParser', $parser);

        $this->assertTrue($parser->getRules(true)['all']);
        $this->assertTrue($parser->export()['']['all']);
        $this->assertTrue($parser->export()['googlebot']['all']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('all')) > 30);

        $this->assertTrue($parser->getRules(true)['noindex']);
        $this->assertTrue($parser->export()['']['noindex']);
        $this->assertTrue($parser->export()['googlebot']['noindex']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('noindex')) > 30);

        $this->assertTrue($parser->getRules(true)['nofollow']);
        $this->assertTrue($parser->export()['']['nofollow']);
        $this->assertTrue($parser->export()['googlebot']['nofollow']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('nofollow')) > 30);

        $this->assertTrue($parser->getRules(true)['none']);
        $this->assertTrue($parser->export()['']['none']);
        $this->assertTrue($parser->export()['googlebot']['none']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('none')) > 30);

        $this->assertTrue($parser->getRules(true)['noarchive']);
        $this->assertTrue($parser->export()['']['noarchive']);
        $this->assertTrue($parser->export()['googlebot']['noarchive']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('noarchive')) > 30);

        $this->assertTrue($parser->getRules(true)['nosnippet']);
        $this->assertTrue($parser->export()['']['nosnippet']);
        $this->assertTrue($parser->export()['googlebot']['nosnippet']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('nosnippet')) > 30);

        $this->assertTrue($parser->getRules(true)['noodp']);
        $this->assertTrue($parser->export()['']['noodp']);
        $this->assertTrue($parser->export()['googlebot']['noodp']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('noodp')) > 30);

        $this->assertTrue($parser->getRules(true)['notranslate']);
        $this->assertTrue($parser->export()['']['notranslate']);
        $this->assertTrue($parser->export()['googlebot']['notranslate']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('notranslate')) > 30);

        $this->assertTrue($parser->getRules(true)['noimageindex']);
        $this->assertTrue($parser->export()['']['noimageindex']);
        $this->assertTrue($parser->export()['googlebot']['noimageindex']);
        $this->assertTrue(mb_strlen($parser->getDirectiveMeaning('noimageindex')) > 30);
    }

    /**
     * Generate test data
     * @return array
     */
    public function generateDataForTest()
    {
        return [
            [
                'googlebot',
                <<<STRING
HTTP/1.1 200 OK
Date: Tue, 25 May 2010 21:42:43 GMT
X-Robots-Tag: all
X-Robots-Tag: noindex
X-Robots-Tag: nofollow
X-Robots-Tag: none
X-Robots-Tag: noarchive
X-Robots-Tag: nosnippet
X-Robots-Tag: noodp
X-Robots-Tag: notranslate
X-Robots-Tag: noimageindex
X-Robots-Tag: unavailable_after: Friday, 25 Jun 2010 15:00:00 PST
X-Robots-Tag: googlebot: all, none, nofollow,nosnippet,notranslate, unavailable_after: Friday, 25 Jun 2010 15:00:00 PST, noindex, noarchive, noodp,noimageindex
STRING
            ]
        ];
    }
}
