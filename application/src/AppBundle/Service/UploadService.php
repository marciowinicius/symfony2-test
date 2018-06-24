<?php
namespace AppBundle\Service;

class UploadService
{
    private function getProcessedFile($file)
    {
        libxml_use_internal_errors(true);

        $xml = @simplexml_load_file($file);
        $err = libxml_get_errors();

        if (count($err) > 0)
        {
            $rows = file($file);

            foreach ($err as $error)
            {
                if (strpos($error->message, 'Opening and ending tag mismatch') !== false)
                {
                    $line   = trim(preg_replace('/Opening and ending tag mismatch: (.*) line.*/', '$1', $error->message));
                    $line_error  = $error->line - 2;

                    if (isset($rows[$line_error]))
                    {
                        if (strpos($rows[$line_error], '/') === false)
                        {
                            $rows[$line_error] = '</' . $line . '>';
                        }
                    }
                }
            }

            $xml_implode = implode("", $rows);
            $xml = simplexml_load_string($xml_implode);
        }

        return $xml;
    }
    public function upload($files)
    {
        $arr = array();

        if (isset($files['tmp_name']))
        {
            foreach ($files['tmp_name'] as $key => $file)
            {
                if ($files['type'][$key] === 'text/xml' || $files['type'][$key] === 'application/xml')
                {
                    $xml = $this->getProcessedFile($file);
                    $arr[] = $xml;
                }
            }

            return $arr;
        }
    }
}