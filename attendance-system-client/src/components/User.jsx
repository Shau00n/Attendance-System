import React, { useState, useEffect } from "react";

const User = () => {
  const [userList, setUserList] = useState([]);

  const getUsers = async () => {
    const response = await fetch("/users");
    const data = await response.json();
    setUserList(data);
  };

  const createUser = async (user) => {
    const response = await fetch("/users", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(user),
    });
    const data = await response.json();
    setUserList([...userList, data]);
  };

  const updateUser = async (id, updatedUser) => {
    const response = await fetch(`/users/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(updatedUser),
    });
    const data = await response.json();
    const updatedList = userList.map((user) => (user.id === id ? data : user));
    setUserList(updatedList);
  };

  const deleteUser = async (id) => {
    await fetch(`/users/${id}`, {
      method: "DELETE",
    });
    const updatedList = userList.filter((user) => user.id !== id);
    setUserList(updatedList);
  };

  useEffect(() => {
    getUsers();
  }, []);

  return <div>// 表示するコンテンツを記述</div>;
};

export default User;
