<?php namespace BackupManager\Filesystems;

use League\Flysystem\PhpseclibV3\SftpAdapter;
use League\Flysystem\PhpseclibV3\SftpConnectionProvider;
use League\Flysystem\Filesystem as Flysystem;

/**
 * Class SftpFilesystem
 * @package BackupManager\Filesystems
 */
class SftpFilesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     * @param $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'sftp';
    }

    /**
     * @param array $config
     * @return Flysystem
     */
    public function get(array $config)
    {
        $provider = SftpConnectionProvider::fromArray($config);
        $root = $config['root'] ?? '/';
        return new Flysystem(new SftpAdapter($provider, $root));
    }
}
