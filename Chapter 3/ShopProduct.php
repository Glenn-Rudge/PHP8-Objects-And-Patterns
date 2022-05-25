<?php

	class ShopProduct
	{
		private int|float $discount = 0;

		public function __construct(
			private string $title, 
			private string $producerFirstName, 
			private string $producerMainName, 
			protected int|float $price)
		{}

		public function getProducerFirstName(): string
		{
			return $this->producerFirstName;
		}

		public function getProducerMainName(): string
		{
			return $this->producerMainName;
		}

		public function setDiscount(int|float $num): void
		{
			$this->discount = $num;
		}

		public function getDiscount(): int
		{
			return $this->discount;
		}

		public function getTitle(): string
		{
			return $this->title;
		}

		public function getPrice(): int|float
		{
			return ($this->price - $this->discount);
		}

		public function getProducer(): string
		{
			return "{$this->producerFirstName} {$this->producerMainName}";
		}

		public function getSummaryLine(): string
		{
			$base = "{$this->title} ({$this->producerMainName}, ";
			$base .= "{$this->producerFirstName} )";
			return $base;
		}
	}

	class CdProduct extends ShopProduct
	{
		public function __construct(string $title, string $firstName, string $mainName, int|float $price, private int $playLength)
		{
			parent::__construct($title, $firstName, $mainName, $price);

			$this->playLength = $playLength;
		}

		public function getPlayLength(): int
		{
			return $this->playLength;
		}

		public function getSummaryLine(): string
		{
			$base = parent::getSummaryLine();
			$base .= "play length - $this->playLength";

			return $base;
		}
	}

	class BookProduct extends ShopProduct
	{
		public function __construct(string $title, string $firstName, string $mainName, int|float $price, private int $numPages)
		{
			parent::__construct($title, $firstName, $mainName, $price);

			$this->numPages = $numPages;
		}
		
		public function getNumberOfPages(): int
		{
			return $this->numPages;
		}

		public function getSummaryLine(): string
		{
			$base = parent::getSummaryLine();
			$base .= ": page count - {$this->numPages}";

			return $base;
		}
		
		public function getPrice (): int|float
		{
			return $this->price;
		}

	}

	class ShopProductWriter
	{
		private $products = [];

		public function addProduct(ShopProduct $shopProduct): void
		{
			$this->products[] = $shopProduct;
		}

		public function write(): void
		{
			$str = "";

			foreach ($this->products as $shopProduct)
			{
				$str .= "$shopProduct->getTitle(): ";
				$str .= "{$shopProduct->getProducer()} ";
				$str .= "{$shopProduct->getPrice()} \n";
			}

			print $str;
		}
	}

	$product4 = new CdProduct("Exile On Coldharbour Lane", "The", "Alabama 3", 10.99, 55.00);
	print PHP_EOL;
	$product5 = new CdProduct("Lorem Ipsum Band", "The", "Alabama 3", 12.99, 100.75);

	TODO:// fix error on ShopProduct title.
	$newShopProduct = new ShopProduct("Lorem Ipsum", "Ipsum Producer", "Ipsum Producer LLC", 100);

	$newBookProduct = new BookProduct("Catcher In The Rye", "JD", "Salanger", 25.75, 375);

	$writer = new ShopProductWriter();
	// $writer->addProduct($product4);
	// $writer->addProduct($product5);

	$writer->addProduct($newShopProduct);

	$writer->write();


//	$product4->setDiscount(1.75);
////	print $product4->getPrice() . PHP_EOL;
//	print $product4->getPrice();
//
//	$newShopProduct = new ShopProduct("Lorem Ipsum", "Ipsum Producer", "Ipsum Producer LLC", 100);
//
//	$newBookProduct = new BookProduct("Catcher In The Rye", "JD", "Salanger", 25.75, 375);
//
//	print $newBookProduct->getPrice();
