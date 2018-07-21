<table class="" cellspacing=0 border=1>
    <tbody>
        <tr style="height:17px;">
            <td style="font-family:Calibri;text-align:center;font-size:12px;font-weight:bold;min-width:50px" colspan=9>
                WEB APPLICATION GROUP REPORT
            </td>
        </tr>
        <tr style="height:17px;">
            <td style="font-family:Calibri;text-align:center;font-size:12px;font-weight:bold;min-width:50px" colspan=9>
                REPORTER: HAO NGUYEN
            </td>
        </tr>
        <tr style="height:0px;">
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
            <td style="min-width:50px">
                &nbsp;
            </td>
        </tr>
        <tr style="height:17px;">
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                No
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Project
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Task Name
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Task ID
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                PIC
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Start Date
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Completed Date
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Completed
            </td>
            <td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#ffff00;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;min-width:50px">
                Note/ Status
            </td>
        </tr>
        <?php
        $i = 1;
        foreach($rows as $row) {
            if($row['status_name'] == '100%') {
                $color_txt = '579d1c';
            } else {
                $color_txt = '000000';
            }
            ?>
            <tr style="height:27px;">
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$i++;?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$row['project_name'];?>
                </td>
                <td style="font-family:Calibri;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$row['task_name'];?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$row['taskid'];?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$row['user_name'];?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=date('d-M-Y', strtotime($row['start_time']));?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=date('d-M-Y', strtotime($row['end_time']));?>
                </td>
                <td style="font-family:Calibri;text-align:center;font-size:10px;color:#<?=$color_txt?>;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;min-width:50px">
                    <?=$row['status_name'];?>
                </td>
                <td style="min-width:50px">
                    <?=$row['note'];?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>