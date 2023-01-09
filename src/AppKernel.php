<?php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Vich\UploaderBundle\VichUploaderBundle(),

        ];
    }
}
?>