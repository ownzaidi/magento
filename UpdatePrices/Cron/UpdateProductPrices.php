<?php

namespace Falcon\UpdatePrices\Cron;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Config\ScopeConfigInterface;


class UpdateProductPrices
{


    const XML_PATH_ENABLE_CRON = 'part_blue/general/active';
    const XML_PATH_CSV_FILE = 'part_blue/general/file_id';
    /**
     * @var string
     */
    private $progressFile;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ScopeConfigInterface $scopeConfig,
        \Psr\Log\LoggerInterface $logger,
    ) {
        $this->productRepository = $productRepository;
        $this->scopeConfig = $scopeConfig;
        $this->logger=$logger;
        $this->progressFile = BP . '/var/import/processed_chunks.json'; // Track processed chunks
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function process()
    {
        $isEnabled = $this->scopeConfig->getValue(self::XML_PATH_ENABLE_CRON,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($isEnabled == 1 ) {
            $value= $this->scopeConfig->getValue(
                self::XML_PATH_CSV_FILE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $csvFilePath = BP . '/pub/media/import/' . $value;

            if ($value == null ) {
                throw new \Exception("CSV file not found at {$csvFilePath}");
            }

            $csvData = array_map('str_getcsv', file($csvFilePath));
            array_shift($csvData);

            // Read or initialize progress
            $progress = file_exists($this->progressFile)
                ? json_decode(file_get_contents($this->progressFile), true)
                : 0;

            $chunks = array_chunk($csvData, 30);
            if (isset($chunks[$progress])) {
                $this->updateChunk($chunks[$progress]);
                $progress++;
                file_put_contents($this->progressFile, json_encode($progress));
            } else {
                echo "All chunks processed.\n";
            }
        }
    }

    /**
     * @param array $chunk
     * @return void
     */
    public function updateChunk(array $chunk)
    {
        foreach ($chunk as $row) {
            [$sku, $price] = $row;
            try {
                $product = $this->productRepository->get($sku);
                $product->setPrice($price);
                $this->productRepository->save($product);
            } catch (NoSuchEntityException $e) {
                $this->logger->warning("Product with SKU {$sku} not found.");
                continue;
            } catch (\Exception $e) {
                $this->logger->error("Error updating SKU {$sku}: " . $e->getMessage());
                continue;
            }
        }
    }
}
