<?php

declare( strict_types = 1 );

namespace Maps\Tests\System;

use Maps\Tests\MapsTestFactory;
use PHPUnit\Framework\TestCase;
use Title;

class CargoQueryTest extends TestCase {

	public function setUp(): void {
		if ( !class_exists( \CargoDisplayFormat::class ) ) {
			$this->markTestSkipped( 'Cargo is not available' );
		}
	}

	public function testCargoQuery() {
		$content = $this->getCargoMapOutput();

		$this->assertContains( '<div id="map_leaflet_', $content );
		$this->assertContains( '"GeoJsonSource":"TestGeoJson"', $content );
		$this->assertContains( '"GeoJsonRevisionId":', $content );
		$this->assertContains( '"geojson":{"type":"FeatureCollection"', $content );
	}

	private function getCargoMapOutput(): string {
		return MapsTestFactory::newTestInstance()->getPageContentFetcher()
			->getPageContent( 'CargoMap' )->getParserOutput( Title::newFromText( 'CargoMap' ) )->getText();
	}

}
