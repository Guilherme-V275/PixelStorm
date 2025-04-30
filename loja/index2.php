<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja Simples</title>
    <style>
        .produto, #carrinho, #cliente-form {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            width: 600px;
        }
        img {
            max-width: 250px;
            max-height: 250px;
        }
        #mensagem {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            display: none; /* Inicialmente oculto */
            z-index: 1000; /* Garante que a mensagem fique acima de outros elementos */
            opacity: 0;
            transition: opacity 0.5s ease-in-out; /* Animação de fade-in e fade-out */
        }
       
            

            nav {
                background-color: #333;
                padding: 10px 0;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
            }

            nav ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
            }

            nav ul li {
                margin: 0 15px;
            }

            nav ul li a {
                text-decoration: none;
                color: #ffffff;
                font-weight: bold;
                padding: 5px 10px;
                transition: background-color 0.3s;
            }
            nav ul li a .hover {
                background-color: #555;
                border-radius  : 5px;
            }

            /* Centraliza imagem e texto */
            .content {
                display: flex;
                flex-direction: column;
                /* Organiza verticalmente */
                align-items: center;
                /* Centraliza horizontalmente */
                justify-content: center;
                /* Centraliza verticalmente */
                height: 100vh;
                /* Ocupa a altura da tela */
                text-align: center;
                margin-top: 10px;
                /* Compensa o espaço do menu */
            }

            .content img {
                max-width: 400px;
                /* Tamanho máximo da imagem */
                height: auto;
                /* Mantém as proporções */
                margin-bottom: 20px;
                /* Espaço entre imagem e texto */
            }
            .titulo {
                padding-top: 5px;
            }
            
    </style>
</head>
<body>
<nav>
            <ul>
                <li><a href="incicio_site.html">Início</a></li>
                <li><a href="sobre_o_site.html2.html">Sobre</a></li>
                <li><a href="https://localhost/loja/index2.php">Produtos</a></li>
                <li><a href="pagina_de_novidades.html">Novidades</a></li>
                <li><a href="pagina_de_contato.html">Contatos</a></li>
            </ul>
        </nav>
<div class="titulo">
<h1>Produtos disponíveis</h1>
</div>
<div class="produto">
    <img src="https://i.ytimg.com/vi/30QFajq-lQg/maxresdefault.jpg">
    <h3>Peraphone Max</h3>
    <p>R$ 2499,90</p>
    <button onclick="adicionarAoCarrinho('Peraphone Max', 2499.90)">Comprar</button>
</div>

<div class="produto">
    <img src="https://th.bing.com/th/id/OIP.GwSJdGB-l9WTjBcaqNofgwAAAA?rs=1&pid=ImgDetMain">
    <h3>Peraphone Mega</h3>
    <p>R$ 2199,90</p>
    <button onclick="adicionarAoCarrinho('Peraphone Mega', 2199.90)">Comprar</button>
</div>

<div class="produto">
    <img src="https://th.bing.com/th/id/OIP.goJte0L8rVW0AmWZJGbdhAHaHr?rs=1&pid=ImgDetMain" alt="">
    <h3>Peraphone Mini</h3>
    <p>R$ 1899,90</p>
    <button onclick="adicionarAoCarrinho('Peraphone Mini', 1899.90)">Comprar</button>
</div>

<div id="carrinho">
    <h2>Carrinho</h2>
    <ul id="lista-carrinho"></ul>
    <p id="total"></p>
</div>

<div id="cliente-form">
    <h2>Finalizar Compra</h2>
    <form action="finalizar.php" method="post" onsubmit="return enviarCarrinho()">
        <input type="text" name="nome" placeholder="Seu nome" required><br><br>
        <input type="email" name="email" placeholder="Seu e-mail" required><br><br>
        <input type="hidden" name="carrinho_json" id="carrinho_json">
        <button type="submit">Finalizar</button>
    </form>
</div>
<div id="mensagem"></div>

<script>
    let carrinho = [];
    let total = 0;

    function adicionarAoCarrinho(produto, preco) {
        carrinho.push({produto, preco});
        total += preco;
        atualizarCarrinho();
    }

    function atualizarCarrinho() {
        const lista = document.getElementById('lista-carrinho');
        lista.innerHTML = '';

        carrinho.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.produto} - R$ ${item.preco.toFixed(2)}`;
            lista.appendChild(li);
        });

        document.getElementById('total').textContent = `Total: R$ ${total.toFixed(2)}`;
    }

    function enviarCarrinho() {
        // Impede o envio tradicional do formulário
        event.preventDefault();
        
        // Coleta os dados do formulário
        const nome = document.querySelector('input[name="nome"]').value;
        const email = document.querySelector('input[name="email"]').value;

        // Exibe a mensagem flutuante
        const mensagem = document.getElementById('mensagem');
        mensagem.textContent = `Obrigado, ${nome}! Olhe o seu e-mail.`;

        // Torna a mensagem visível
        mensagem.style.display = 'block';
        mensagem.style.opacity = 1;

        // Anima a mensagem para desaparecer depois de 3 segundos
        setTimeout(() => {
            mensagem.style.opacity = 0; // Faz a mensagem desaparecer com animação
            setTimeout(() => {
                mensagem.style.display = 'none'; // Esconde a mensagem completamente após o fade-out
            }, 500); // Tempo do fade-out
        }, 3000); // A mensagem desaparece após 3 segundos

        // Limpa o formulário
        document.getElementById('form_cliente').reset();

        // Aqui você pode adicionar lógica para enviar os dados via AJAX (simulação de envio para o servidor)
        console.log('Dados enviados para o servidor: ', { nome, email, carrinho });

        return false; // Impede o recarregamento da página
    }
</script>

</body>
</html>