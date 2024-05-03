<?php

use yii\web\View;
use yii\helpers\Html;
use app\assets\AppAsset;
use kartik\file\FileInput;
use yii\bootstrap5\ActiveForm;


AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $product app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/**
 
 *
 * @author Leonardo <leonardoesaug@gmail.com>
 */
$this->title = 'Agregar Producto';
?>
<style>
    .questionnaire-table th,
    .questionnaire-table td {
        padding: 6px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .questionnaire-table th {
        background-color: #235b4e;
        color: white;
    }

    .questionnaire-table td {
        background-color: #f2f2f2;
    }

    .questionnaire-table td.highlight {
        background-color: #4CAF50;
    }

    .questionnaire-table input[type="radio"]:checked+label {
        color: white;
        font-weight: bold;
    }

    .questionnaire-table td.selected {
        background-color: #7b9371;
    }

    input[type="radio"] {
        display: none;
    }
</style>
<section class="contact-box-section">


    <div class="right-sidebar-box card-questionnaire">

        <h3 style="color: #235b4e;">Rellena los datos correspondientes a tu producto</h3>
        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px;"></div>
        <?= Html::beginForm('', 'post', ['enctype' => 'multipart/form-data']) ?>

        <?= Html::csrfMetaTags() ?>
        <div class="row">
            <div class="col-xxl-4 col-lg-6 col-sm-12">
                <div class="mb-md-4 mb-3 custom-form">
                    <div class="custom-input-product-form">
                        <label for="pro_name">Nombre del producto:</label>
                        <input type="text" id="pro_name" name="Product[pro_name]">
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6 col-sm-12">
                <div class="mb-md-8 mb-3 custom-form">
                    <div class="custom-input-product-form">
                        <label for="pro_description">Descripción del producto:</label>
                        <textarea id="pro_description" name="Product[pro_description]"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-lg-4 col-sm-12">
                <div class="mb-md-4 mb-3 custom-form">
                    <div class="custom-input-product-form">
                        <label for="productLine" class="form-label">Categoría:</label>
                        <select name="CatLineAssignment[clias_fkline]" id="productLine" class="form-select" style="border: none;">
                            <option value="" disabled selected>Seleccione una categoría </option>
                            <?php foreach ($lineOptions as $key => $value) : ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-lg-6 col-sm-12">
                <div class="mb-md-8 mb-3 custom-form">
                    <label for="image">Sube hasta 3 fotos de tu producto:</label>
                    <div class="custom-file-input-container" style="display: block; align-items: stretch;">
                        <?php
                        echo FileInput::widget([
                            'name' => 'ProductImage[eventImage][]', // Cambia el nombre para que sea un array
                            'language' => 'es',
                            'options' => ['multiple' => true], // Permite la carga de múltiples archivos
                            'pluginOptions' => [
                                'showPreview' => true,
                                'showCaption' => true,
                                'showUpload' => false,
                                'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
                                'maxFileCount' => 3,
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="questionnaire-table">
                <label for="matriz dam">Contesta de acuerdo a los detalles de tu producto:</label>
                <thead>
                    <tr>
                        <th>Preguntas</th>
                        <th>Respuesta 1</th>
                        <th>Respuesta 2</th>
                        <th>Respuesta 3</th>
                        <th>Respuesta 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 1: Origen de la Materia Prima (Principal o inicial)</td>
                        <td>
                            <input type="radio" id="question1_a" name="Product[mdam_question1]" value="answer1_a">
                            <label for="question1_a">Natural</label><br>
                        </td>
                        <td>
                            <input type="radio" id="question1_b" name="Product[mdam_question1]" value="answer1_b">
                            <label for="question1_b">Natural (Procesado industrialmente) </label><br>
                        </td>
                        <td>
                            <input type="radio" id="question1_c" name="Product[mdam_question1]" value="answer1_c">
                            <label for="question1_c">Artificial </label><br>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 2: Obtención de la Materia Prima (Principal o inicial)</td>
                        <td>
                            <input type="radio" id="question2_d" name="Product[mdam_question2]" value="answer2_a">
                            <label for="question2_d">Siembra/Cría/Manejo </label><br>
                        </td>
                        <td>
                            <input type="radio" id="question2_e" name="Product[mdam_question2]" value="answer2_b">
                            <label for="question2_e">Recolección/Extracción </label><br>
                        </td>
                        <td>
                            <input type="radio" id="question2_f" name="Product[mdam_question2]" value="answer2_c">
                            <label for="question2_f">Reciclaje </label><br>
                        </td>
                        <td>
                            <input type="radio" id="question2_g" name="Product[mdam_question2]" value="answer2_d">
                            <label for="question2_g">Compra </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 3: Forma de elaboración de la pieza</td>
                        <td>
                            <input type="radio" id="mdam_question3_h" name="Product[mdam_question3]" value="answer3_a">
                            <label for="mdam_question3_h">Creación total de la pieza </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question3_i" name="Product[mdam_question3]" value="answer3_b">
                            <label for="mdam_question3_i">Engarzado o cosido manualmente </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question3_j" name="Product[mdam_question3]" value="answer3_c">
                            <label for="mdam_question3_j">Enfarzado o cosido con máquina </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question3_k" name="Product[mdam_question3]" value="answer3_d">
                            <label for="mdam_question3_k">Ensamble con pegamento industrial </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 4: Herramientas</td>
                        <td>
                            <input type="radio" id="mdam_question4_l" name="Product[mdam_question4]" value="answer4_a">
                            <label for="mdam_question4_l">Manualmente </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question4_m" name="Product[mdam_question4]" value="answer4_b">
                            <label for="mdam_question4_m">Herramientas adaptadas por el productor o alguien de la región </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question4_n" name="Product[mdam_question4]" value="answer4_c">
                            <label for="mdam_question4_n">Maquinaria eléctrica </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question4_o" name="Product[mdam_question4]" value="answer4_d">
                            <label for="mdam_question4_o">Herramientas comerciales </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 5: Teñido/Pintado</td>
                        <td>
                            <input type="radio" id="mdam_question5_p" name="Product[mdam_question5]" value="answer5_a">
                            <label for="mdam_question5_p">Colorantes, pigmentos naturales / al natural y esmalte para vidriado </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question5_q" name="Product[mdam_question5]" value="answer5_c">
                            <label for="mdam_question5_q">Material adquirido con color </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question5_r" name="Product[mdam_question5]" value="answer5_d">
                            <label for="mdam_question5_r">Pinturas industriales </label><br>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 6: Tiempo de elaboración</td>
                        <td>
                            <input type="radio" id="mdam_question6_s" name="Product[mdam_question6]" value="answer6_a">
                            <label for="mdam_question6_s">Más de 24 horas </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question6_t" name="Product[mdam_question6]" value="answer6_b">
                            <label for="mdam_question6_t">De 9 a 24 horas </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question6_u" name="Product[mdam_question6]" value="answer6_c">
                            <label for="mdam_question6_u">De 5 a 8 horas </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question6_v" name="Product[mdam_question6]" value="answer6_d">
                            <label for="mdam_question6_v">Hasta 4 horas </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 7: Diseño del producto</td>
                        <td>
                            <input type="radio" id="mdam_question7_w" name="Product[mdam_question7]" value="answer7_a">
                            <label for="mdam_question7_w">Tradicional </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question7_x" name="Product[mdam_question7]" value="answer7_b">
                            <label for="mdam_question7_x">Tradicional con Innovación </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question7_y" name="Product[mdam_question7]" value="answer7_c">
                            <label for="mdam_question7_y">Nuevo / Neoartesanía </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question7_z" name="Product[mdam_question7]" value="answer7_d">
                            <label for="mdam_question7_z">Estilos </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 8: Representatividad</td>
                        <td>
                            <input type="radio" id="mdam_question8_a2" name="Product[mdam_question8]" value="answer8_a">
                            <label for="mdam_question8_a2">Local / Región </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question8_b2" name="Product[mdam_question8]" value="answer8_b">
                            <label for="mdam_question8_b2">Estado </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question8_c2" name="Product[mdam_question8]" value="answer8_c">
                            <label for="mdam_question8_c2">País </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question8_d2" name="Product[mdam_question8]" value="answer8_d">
                            <label for="mdam_question8_d2">No es representativo </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 9: Uso del producto</td>
                        <td>
                            <input type="radio" id="mdam_question9_e2" name="Product[mdam_question9]" value="answer9_a">
                            <label for="mdam_question9_e2">Ceremonia </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question9_f2" name="Product[mdam_question9]" value="answer9_b">
                            <label for="mdam_question9_f2">Utilitario </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question9_g2" name="Product[mdam_question9]" value="answer9_c">
                            <label for="mdam_question9_g2">Decorativo utilitario </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question9_h2" name="Product[mdam_question9]" value="answer9_d">
                            <label for="mdam_question9_h2">Solo decorativo </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 10: División del trabajo</td>
                        <td>
                            <input type="radio" id="mdam_question10_i2" name="Product[mdam_question10]" value="answer10_a">
                            <label for="mdam_question10_i2">Por género o por edad </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question10_j2" name="Product[mdam_question10]" value="answer10_b">
                            <label for="mdam_question10_j2">Por especialidad</label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question10_k2" name="Product[mdam_question10]" value="answer10_c">
                            <label for="mdam_question10_k2">Individual </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question10_l2" name="Product[mdam_question10]" value="answer10_d">
                            <label for="mdam_question10_l2">Sin división </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 11: Transmisión del conocimiento</td>
                        <td>
                            <input type="radio" id="mdam_question11_m2" name="Product[mdam_question11]" value="answer11_a">
                            <label for="mdam_question11_m2">Herencia familiar/Legado cultural </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question11_n2" name="Product[mdam_question11]" value="answer11_b">
                            <label for="mdam_question11_n2">Capacitación impartida por una institución o persona externa </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question11_o2" name="Product[mdam_question11]" value="answer11_c">
                            <label for="mdam_question11_o2">Autoaprendizaje </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question11_p2" name="Product[mdam_question11]" value="answer11_d">
                            <label for="mdam_question11_p2">Cursos </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #dbece3; color: black;">Pregunta 12: Pertenece a un grupo étnico que elabora un producto tradicional</td>
                        <td>
                            <input type="radio" id="mdam_question12_q2" name="Product[mdam_question12]" value="answer12_a">
                            <label for="mdam_question12_q2">Sí </label><br>
                        </td>
                        <td>
                            <input type="radio" id="mdam_question12_r2" name="Product[mdam_question12]" value="answer12_b">
                            <label for="mdam_question12_r2">No </label><br>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-top:10px"></div>
        <?= Html::submitButton('Guardar Producto', ['class' => 'btn btn-success mr-2', 'style' => 'background-color: #235b4e; color: white;']) ?>
        <!-- </form> -->
        <?= Html::endForm() ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var cells = document.querySelectorAll('.questionnaire-table td');
                cells.forEach(function(cell) {
                    cell.addEventListener('click', function() {
                        var radioButton = this.querySelector('input[type="radio"]');
                        if (radioButton) {
                            radioButton.click();
                        }
                    });
                });

                var radioButtons = document.querySelectorAll('input[type="radio"]');


                radioButtons.forEach(function(radioButton) {

                    radioButton.addEventListener('change', function() {

                        var cell = this.closest('td');

                        cell.parentElement.querySelectorAll('td').forEach(function(td) {
                            td.classList.remove('selected');
                        });

                        cell.classList.add('selected');
                    });
                });
            });
        </script>


    </div>
</section>


</div>