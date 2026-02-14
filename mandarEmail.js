const express = require('express');
const nodemailer = require('nodemailer');
const cors = require('cors');
const crypto = require('crypto');

let codigos = {};

const app = express();
app.use(cors());
app.use(express.json());

const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'misaelcardoso778@gmail.com',
    pass: ''
  }
});



app.post('/link-recuperacao', (req, res) => {
  const email = req.body.email;
  const usuario = req.body.usuario;
  const idUser = req.body.id;
  const token = crypto.randomBytes(16).toString('hex');
  codigos[idUser] = token; // Armazena o token associado ao id do usuário
  const mailOptions = {
    from: 'Acolhe Food <misaelcardoso778@gmail.com>',
    to: 'misaelcardoso775@gmail.com',
    subject: 'Verificação de Email',
    html: `Olá ${usuario},<br><br> Clique no link para recuperar sua senha: <br><a href="http://localhost/Project/esqueceuSenha/novaSenha.php?token=${token}&id=${idUser}">Recuperar senha</a>`
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.error(error);
      res.status(500).send('Erro ao enviar o email');
    } else {
      console.log('Email enviado:', info.response);
      res.send('Email enviado com sucesso!');
    }
  });
});

app.post('/verificar-codigo', (req, res) => {
  const { token, idUser } = req.body;

  if(codigos[idUser] && codigos[idUser].toString() === token.toString()) {
    delete codigos[idUser]; // Remove o código após a verificação
    res.send({sucesso: true});
  }
  else{
    res.send({sucesso: false});
  }
})

app.listen(3000, () => {
  console.log('Servidor rodando em http://localhost:3000');
});

