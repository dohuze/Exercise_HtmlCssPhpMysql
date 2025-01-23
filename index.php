<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Сменная выработка</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: "Roboto", sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: #f0f0f0;
                font-size: 22px;
                min-height: 100vh;
            }
            header {
                width: calc(100% - 40px);
                display: flex;
                height: 20px;
                justify-content: space-between;
                align-items: center;
                padding: 30px 20px;
                background-color: #f0f0f0;
                border-radius: 0 0 15px 15px;
                position: fixed;
                top: 0;
                z-index: 1000;
            }
            .title {
                font-size: 28px;
                font-weight: bold;
                color: #003366;
                transition: color 0.3s, transform 0.3s;
            }
            .status-block {
                background-color: rgba(255, 255, 255, 0.95);
                padding: 12px 17px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                transition: transform 0.3s;
            }
            .status-block:hover {
                transform: scale(1.05);
            }
            .status {
                font-size: 20px;
                font-weight: 600;
            }
            .status .blue {
                color: #007bff;
            }
            .status .gray {
                color: gray;
            }
            .blocks-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                width: 90%;
                margin-top: 100px;
                animation: fadeIn 1.5s ease-in;
            }
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            .block {
                aspect-ratio: 4/3;
                height: 270px;
                background-color: rgba(255, 255, 255, 0.95);
                border: 1px solid #ced4da;
                margin: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 15px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                position: relative;
                transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            }
            .block:hover {
                transform: scale(1.08);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                background-color: #f8f9fa;
            }
            .circle {
                aspect-ratio: 1/1;
                min-height: 70%;
                border-radius: 50%;
                background: conic-gradient(#4caf50 0deg, #4caf50 0deg, #ddd 0deg, #ddd 360deg);
                position: relative;
                transition: background 2s ease-out;
            }
            .circle::before {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100px;
                height: 100px;
                background-color: rgba(255, 255, 255, 1);
                border-radius: 50%;
                transform: translate(-50%, -50%);
            }
            .percentage {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 20px;
                font-weight: bold;
                color: #333;
                animation: popIn 1s ease-out;
            }
            @keyframes popIn {
                0% {
                    transform: translate(-50%, -50%) scale(0);
                }
                100% {
                    transform: translate(-50%, -50%) scale(1);
                }
            }
            .number {
                position: absolute;
                top: 10px;
                left: 10px;
                font-weight: bold;
                font-size: 16px;
                color: #333;
            }
            .type {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 14px;
                color: gray;
                text-align: right;
                transform: translate(0px, 5px);
				width: 70px;
            }
            .name {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 16px;
                font-weight: normal;
                color: #333;
            }
            .logo-container {
                display: flex;
                align-items: center;
            }
            .logo {
                max-height: 45px;
            }
            @media (max-width: 700px) {
                .title {
                    font-size: 15px;
                }
                .status-block {
                    padding: 7px 10px;
                    border-radius: 5px;
                }
                .status {
                    font-size: 13px;
                }
            }
            @media (max-width: 450px) {
                .title {
                    font-size: 12px;
                }
                .status-block {
                    padding: 5px 7px;
                    border-radius: 4px;
                }
                .status {
                    font-size: 10px;
                }
                .logo {
                    max-height: 30px;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo-container">
                <img class="logo" src="logo.png" />
                <div>
                    <div class="title">Сменная выработка</div>
                    <div class="title">станков №3</div>
                </div>
            </div>
            <div class="status-block">
                <div class="status"><span class="blue">ИЗГОТОВЛЕНО</span> / <span class="gray">ОСТАЛОСЬ</span></div>
            </div>
        </header>
        <div class="blocks-container" id="blocks-container">
            <div class="block" data-percentage="75">
                <div class="number">1-1-01</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>75%</strong></div>
                <div class="name">Александрова И.И.</div>
            </div>
            <div class="block" data-percentage="60">
                <div class="number">1-1-02</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>60%</strong></div>
                <div class="name">Петров П.П.</div>
            </div>
            <div class="block" data-percentage="90">
                <div class="number">1-1-03</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>90%</strong></div>
                <div class="name">Иванов И.И.</div>
            </div>
            <div class="block" data-percentage="45">
                <div class="number">1-1-04</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>45%</strong></div>
                <div class="name">Сидорова С.С.</div>
            </div>
            <div class="block" data-percentage="80">
                <div class="number">1-1-05</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>80%</strong></div>
                <div class="name">Кузнецов К.К.</div>
            </div>
            <div class="block" data-percentage="50">
                <div class="number">1-1-06</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>50%</strong></div>
                <div class="name">Морозов М.М.</div>
            </div>
            <div class="block" data-percentage="95">
                <div class="number">1-1-07</div>
                <div class="type">
                    Токарная<br />
                    с ЧПУ 4
                </div>
                <div class="circle"></div>
                <div class="percentage"><strong>95%</strong></div>
                <div class="name">Васильев В.В.</div>
            </div>
        </div>

        <script>

        </script>
		
        <script>
			function periodic() {
				var xhr_periodic = new XMLHttpRequest();
				xhr_periodic.open("POST", "/jobs/handler.php" , true);
				xhr_periodic.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr_periodic.send("line=" + line + "&type=pereodic");
				xhr_periodic.onreadystatechange = function() {
					if (xhr_periodic.readyState == 4) {
						if(xhr_periodic.status == 200) {
							//console.log(xhr_periodic.responseText);
							var data = JSON.parse(xhr_periodic.responseText);
							
							var html = '';
							for (let x in data) {
								//console.log(data[x]["workcenter"]);
								html = html + '<div class="block" data-percentage="' + data[x]["precent"] + '"><div class="number">' + data[x]["workcenter"] + '</div><div class="type">' + data[x]["operation"] + '</div><div class="circle"></div><div class="percentage"><strong>' + data[x]["precent"] + '%</strong></div><div class="name">' + data[x]["operator"] + '</div></div>';
							}
							document.getElementById("blocks-container").innerHTML = html;
							
							document.querySelectorAll(".block").forEach((block) => {
								const percentage = block.getAttribute("data-percentage");
								const circle = block.querySelector(".circle");
								const percentageText = block.querySelector(".percentage strong");

								// Устанавливаем текст процента
								percentageText.textContent = `${percentage}%`;

								// Изменяем угол заполнения плавно
								setTimeout(() => {
									circle.style.background = `conic-gradient(
									#4caf50 0deg,
									#4caf50 ${3.6 * percentage}deg,
									#ddd ${3.6 * percentage}deg,
									#ddd 360deg
								)`;
								}, 100); // Задержка для плавного старта анимации
							});
						}
					}
				}
			}
		
			var url = new URL(document.location.href);
			var line = url.searchParams.get("line");
			
			periodic();
			
			setInterval(() => {
				periodic();
			}, 60000);
        </script>
		
    </body>
</html>