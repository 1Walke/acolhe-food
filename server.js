// server.js
import express from 'express';
import nodemailer from 'nodemailer';
import cors from 'cors';
import crypto from 'crypto';
import fetch from "node-fetch";

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

app.post("/registrar", async (req, res) => {
    try {
        // Dados recebidos do frontend
        

        // Requisição ao free.nf (pode precisar ajustar headers se o PHP esperar form-data)
        const resposta = await fetch("https://acolhefood.free.nf/registrar.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json" // ou application/x-www-form-urlencoded
            }
        });

        const texto = await resposta.text();
        res.send(texto);

    } catch (erro) {
        console.error("Erro no proxy:", erro);
        res.status(500).send("Erro ao processar registro");
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});


