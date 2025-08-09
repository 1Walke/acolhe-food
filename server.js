// server.js
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
    pass: 'doab aswf nwtp yttw'
  }
});

app.post('/send-email', (req, res) => {
  const email = req.body.email;
  const codigo = Math.floor(100000 + Math.random() * 900000);
  codigos[email] = codigo; // Armazena o código associado ao email
  const mailOptions = {
    from: 'Acolhe Food <misaelcardoso778@gmail.com>',
    to: 'misael.p@aluno.senai.br',
    subject: 'Verificação de Email',
    text: `Codigo de verificação: ${codigo}`,
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
  const {email, codigoDigitado} =  req.body;

  if(codigos[email] && codigos[email].toString() === codigoDigitado.toString()){
    delete codigos[email]; // Remove o código após a verificação
    res.send({sucesso: true});
  }
  else{
    res.send({sucesso: false});
  }
})

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});

