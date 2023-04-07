
        
        <div style="font-weight: bold;">
            <div style='margin:0 auto;text-align:left;font-family:Arial,Geneva,sans-serif;line-height:150%;border:1px solid #2b3a42;padding:10px;background-color:#fff;font-size:12px;box-sizing:border-box'>
                <div style='background-color:#eee;padding:10px 20px 5px 20px;line-height:150%'>
                    <div style='font-size:1.5em'>
                        <strong><?php echo $store;?> - <?php echo date('Y-m-d H:i:s',time()) ?>.</strong>
                    </div>          
                </div>
                <table style='background-color:#2b3a42;width:100%;font-size:13px;font-family:Arial,Geneva,sans-serif' width='100%' cellspacing='1' cellpadding='1'>
                    <tbody>
                        <tr style='background-color:#2b3a42!important;color:#fff!important;font-weight:bold;text-transform:capitalize'>
                            <td style='white-space:nowrap;width:20%;text-align:left;padding:8px 8px;color:#fff;min-width:150px'>STT</td>
                            <td style='white-space:nowrap;width:40%;padding:8px;color:#ffffff;text-align:left;'>Tên sản phẩm</td>
                            <td style='white-space:nowrap;width:15%;padding:8px;color:#ffffff;text-align:left;'>Tồn kho</td>
                            <td style='white-space:nowrap;width:10%;padding:8px;color:#ffffff;text-align:left'>Xuất kho</td>
                            <td style='white-space:nowrap;width:15%;text-align:right;padding:8px 8px;color:#fff'>Hàng thiếu</td>
                        </tr>                    
                        <?php foreach ($products as $key => $p): ?>
                        <?php if ($p->inventory >= $p->estimates && $p->inventory > 0 && $p->estimates > 0) { ?>  
                        <tr style='background-color:#fff;'>
                            <td style='padding:8px 8px;text-align:center;'><?= $key+1; ?></td>
                            <td style='padding:8px 8px;text-align:center;'></span><?= $p->name ?></td>
                            <td style='padding:8px 8px;text-align:center;'><?= $p->inventory ?></td>
                            <td style='padding:8px 8px;text-align:center;'><?= $p->estimates ?></td>
                            <td style='padding:8px 8px;text-align:center;'></td>
                        </tr> 
                        <?php } else { ?>
                        <?php $thieu = $p->estimates  - $p->inventory; ?>
                        <tr style='background-color:#e67e22;'>
                            <td style='padding:8px 8px;text-align:center;'><?= $key+1; ?></td>
                            <td style='padding:8px 8px;text-align:center;'></span><?= $p->name; ?></td>
                            <td style='padding:8px 8px;text-align:center;'><?= $p->inventory; ?></td>
                            <td style='padding:8px 8px;text-align:center;'><?= $p->estimates; ?></td>
                            <td style='padding:8px 8px;text-align:center;'><?= $thieu; ?></td>
                        </tr> 
                        <?php } ?>
                        <?php endforeach ?>
                                               
                    </tbody>
                </table>
            </div>
        </div>
  