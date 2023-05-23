import { useState } from "react";
import api from "../services/api";
import styled from "styled-components";

const StyledForm = styled.form`
  max-width: 300px;
  margin: 80px auto; // 上部にスペースを追加
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
`;

const StyledLabel = styled.label`
  display: block;
  margin-bottom: 10px;
  padding: 20px;
  margin-right: 70px;
  text-align: center; // テキストを中央寄せ
`;

const StyledInput = styled.input`
  width: 100%;
  padding: 10px;
  font-size: 16px;
  margin-left: 20px; // 左にスペースを追加
  margin-right: 20px; // 右にスペースを追加
`;

const StyledButton = styled.button`
  width: 100%;
  margin-top: 10px;
  padding: 10px;
  font-size: 16px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
`;

// エラーメッセージを表示するコンポーネント
const ErrorMessage = styled.p`
  color: red;
`;

const Login = ({ setLoggedIn }) => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState(null); // エラー状態を管理

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await api.post("/login", { email, password });
      // cookieにtokenを保存
      document.cookie = `token=${response.data.token}`;
      setLoggedIn(true);
    } catch (error) {
      // エラーメッセージをセット
      setError("ログインに失敗しました。");
      console.error(error);
    }
  };

  return (
    <StyledForm onSubmit={handleSubmit}>
      <StyledLabel>
        メールアドレス：
        <StyledInput
          type="email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
      </StyledLabel>
      <StyledLabel>
        パスワード：
        <StyledInput
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
      </StyledLabel>
      <StyledButton type="submit">ログイン</StyledButton>
      {error && <ErrorMessage>{error}</ErrorMessage>}
    </StyledForm>
  );
};

export default Login;
