<?php
namespace Hoborg\Commons;

use Symfony\Component\Config\Loader\LoaderInterface;

class Kernel extends \Symfony\Component\HttpKernel\Kernel {

	/**
	 * @see Symfony\Component\HttpKernel.KernelInterface::registerBundles()
	 */
	public function registerBundles() {
		$bundles = array(
			new \Hoborg\Bundle\CommonsBundle\CommonsBundle(),
			new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new \Symfony\Bundle\TwigBundle\TwigBundle(),
			new \Symfony\Bundle\MonologBundle\MonologBundle(),
			new \Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
		);

		if (in_array($this->getEnvironment(), array('dev', 'test'))) {
			$bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			//$bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			//$bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
		}

		return $bundles;
	}

	/**
	 * @see Symfony\Component\HttpKernel.KernelInterface::registerContainerConfiguration()
	 */
	public function registerContainerConfiguration(LoaderInterface $loader) {
		$loader->load(__DIR__ . '/conf/conf_' . $this->getEnvironment() . '.yml');
	}

	/**
	 * @see Symfony\Component\HttpKernel.Kernel::getCacheDir()
	 */
	public function getCacheDir() {
		return __DIR__ . '/cache';
	}

	/**
	 * @see Symfony\Component\HttpKernel.Kernel::getLogDir()
	 */
	public function getLogDir() {
		return __DIR__ . '/logs';
	}

	/**
	 * @see Symfony\Component\HttpKernel.Kernel::getKernelParameters()
	 */
	protected function getKernelParameters() {
		return array_merge(
			parent::getKernelParameters(),
			array(
				'kernel.conf_dir' => __DIR__ . '/conf',
			)
		);
	}
}