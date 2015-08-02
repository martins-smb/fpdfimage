# FPDF Image

Original written by http://fpdf.de/downloads/addons/45/

## itbz/fpdf Compatible

I have made some changes to make mem_image.php compatible for itbz/fpdf.

### Example Usage
```php

$pdf = new FPDFImage("L","mm","A4");
$pdf->AddPage();
$pdf->SetFont('arial','B',10);
$pdf->Cell(288,5,'Example',0,1,'C');
$pdf->Output("file.pdf","I");

```

### Example usage with davefx/phplot
```php

$pdf = new FPDFImage("L","mm","A4");
$pdf->AddPage();
$pdf->SetFont('arial','B',10);
$pdf->Cell(288,5,'Example',0,1,'C');

$plot = new PHPlot(400, 300);
$plot->SetImageBorderType('plain');
		
$plot->SetPlotType('bars');
$plot->SetDataType('text-data');

$data[0][1] = 10;
$data[1][1] = 20;
$data[2][1] = 30;
$data[0][2] = 20;
$data[1][2] = 30;
$data[2][2] = 40;
$plot->SetDataValues($data);
		
$plot->SetDataColors(array('DarkGreen', 'orange', 'yellow', 'blue', 'cyan', 'magenta', 'brown', 'lavender', 'pink', 'gray', 'red', 'green'));
		
$plot->SetTitle('Example');

$data2 = array("Example 1", "Example 2");
$plot->SetLegend($data2);
		
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');
$plot->SetPrintImage(false);
		
$plot->DrawGraph();

$pdf->GDImage($plot->img,85,90,140);
$pdf->Output("file.pdf","I");

```
