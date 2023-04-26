import React, { useState } from "react";

export const AuthContext = React.createContext();

export const AuthProvider = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);

  const login = (username, password) => {
    // API呼び出しを行い、ログインが成功したら以下を実行
    setIsLoggedIn(true);
    setUser({ username });
  };

  const logout = () => {
    // API呼び出しを行い、ログアウトが成功したら以下を実行
    setIsLoggedIn(false);
    setUser(null);
  };

  return (
    <AuthContext.Provider value={{ isLoggedIn, user, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
