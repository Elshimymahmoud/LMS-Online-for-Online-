<?php


namespace App\Classes;



class GenerateQr
{
    //type = 1-> user ,2->eventin , 3->eventout, 4->group, 5->zone ,6->tools

    public static function generateQrCode($type,$data){
        $Qr = new \SimpleSoftwareIO\QrCode\Generator();
        switch ($type){
            case 1:
                $Qr->generate($data, public_path('storage/qrCodes/'.$data.'.svg'));
              return assetPath('storage/qrCodes/'.$data.'.svg');
                break;
            case 2:
                $Qr->generate($data, '../public/uploads/eventinqr/sp'.$data.'.svg');
                return assetPath('uploads/eventinqr/sp'.$data.'.svg');
                break;
                 case 3:
                $Qr->generate($data, '../public/uploads/eventoutqr/sp'.$data.'.svg');
                return assetPath('uploads/eventoutqr/sp'.$data.'.svg');
                break;
                 case 4:
                $Qr->generate($data, '../public/uploads/groupqr/sp'.$data.'.svg');
                return assetPath('uploads/groupqr/sp'.$data.'.svg');
                break;
                 case 5:
                $Qr->generate($data, '../public/uploads/zoneqr/sp'.$data.'.svg');
                return assetPath('uploads/zoneqr/sp'.$data.'.svg');
                break;
                case 6:
                $Qr->generate($data, '../public/uploads/toolqr/sp'.$data.'.svg');
                return assetPath('uploads/toolqr/sp'.$data.'.svg');
            default:
        }
    }

}
