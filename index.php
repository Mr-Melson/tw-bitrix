<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <?php if (isset($_POST['title'])) { ?>
        <section>
            <?php require_once (__DIR__ . '/core.php') ?>
        </section>
    <? } ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col">

                    <form action="/" method="POST" enctype='multipart/form-data'>
                        
                        <h2>Новая заявка</h2>
                        <div class="form_item">
                            <label for="title">Заголовок заявки</label>
                            <input type="text" name="title" required>
                        </div>
                        
                        <h2>Категория</h2>
                        <div class="form_item">
                            <label>
                                <input 
                                    class="form-check-input mt-0"
                                    type="radio"
                                    value="consumables"
                                    name="category"
                                    required>
                                <span>Масла, автохимия, фильтры, Автоаксессуары, обогреватели, запчасти, сопутствующие товары.</span>
                            </label>

                            <label>
                                <input 
                                    class="form-check-input mt-0"
                                    type="radio"
                                    value="wheels"
                                    name="category">
                                <span>Шины, диски</span>
                            </label>
                        </div>
                        
                        <h2>Вид заявки</h2>
                        <div class="form_item">
                            <label>
                                <input 
                                    class="form-check-input mt-0"
                                    type="radio"
                                    value="price_delivery"
                                    name="type"
                                    required>
                                <span>Запрос цены и сроков доставки</span>
                            </label>

                            <label>
                                <input 
                                    class="form-check-input mt-0"
                                    type="radio"
                                    value="replenishment"
                                    name="type">
                                <span>Пополнение складов</span>
                            </label>
                            
                            <label>
                                <input 
                                    class="form-check-input mt-0"
                                    type="radio"
                                    value="special_orders"
                                    name="type">
                                <span>Спецзаказ</span>
                            </label>
                        </div>

                        <h2>Склад поставки</h2>
                        <div class="form_item">
                            <select name="stock" id="stock">
                                <option disabled selected value> -- Выберите склад поставки -- </option>
                                <option value="1">Склад 1</option>
                                <option value="2">Склад 2</option>
                                <option value="3">Склад 3</option>
                            </select>
                        </div>

                        <h2>Состав заявки</h2>
                        <div class="form_item">
                            
                            <div class="comp_head">
                                <span>Бренд</span>
                                <span>Наименование</span>
                                <span>Количество</span>
                                <span>Фасовка</span>
                                <span>Клиент</span>
                            </div>
                            
                            <div id="comp_rows">
                                <div class="comp_row">
                                    <select name="brand">
                                        <option disabled selected value> -- Выберите бренд -- </option>
                                        <option value="brand_1">Бренд 1</option>
                                        <option value="brand_2">Бренд 2</option>
                                        <option value="brand_3">Бренд 3</option>
                                    </select>
                                    <input type="text" name="comp_title">
                                    <input type="number" name="comp_count" min="0">
                                    <input type="text" name="comp_packaging">
                                    <input type="text" name="comp_client">
                                </div>
                            </div>

                            <div class="control_rows">
                                <button type="button" id="row_plus">+</button>
                                <button type="button" id="row_minus">-</button>
                            </div>
                        </div>
                        
                        <div class="form_item">
                            <input type="file" name="upload_file">    
                        </div>
                        
                        <div class="form_item">
                            <p>Комментарий</p>
                            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                        </div>
                        
                        <div class="form_item">
                            <input type="submit" value="Отправить">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/index.js"></script>
</body>
</html>