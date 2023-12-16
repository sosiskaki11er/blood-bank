import React, { useState } from 'react'
import BloodImg from '../assets/img/svg.png'
import HeartLogo from '../assets/icons/activity-heart.svg'
import ArrowLogo from '../assets/icons/arrow.svg'
import { useNavigate, useSearchParams } from 'react-router-dom'

function Reset() {
    const [email,setEmail] = useState('')
    const [code, setCode] = useState('')
    const [newPassword, setNewPassword] = useState('')
    const [repeatPassword, setRepeatPassword] = useState('')
    const [searchParams, setSearchParams] = useSearchParams();
    const [role, setRole] = useState(searchParams.get('role'))
    const navigate = useNavigate()
    const HandleEmail = (email) => {
        setEmail(email)
    }
    const [login, setLogin] = useState()

    const HandleLogin = () => {
        setLogin(true)
    }
    const HandleCode = (code) => {
        setCode(code)
    }
    const HandleNewPassword = (password) => {
        setNewPassword(password)
    }
    const HandleRepeatPassword = (password) => {
        setRepeatPassword(password)
    }

  return (
    <div className="container">
    <img src={BloodImg} alt='bg' />

    <div className="container flex-col gap-[64px] m-auto max-w-[420px]">
      <div className='container flex-col gap-[24px]'>
        <div className="container gap-[16px] mx-auto">
          <img src={HeartLogo} alt="logo"/>
          <h1>BloodCare</h1>
        </div>
        <h2 className='max-w-[400px] text-center'>Connecting donors and recipients, saving lives.</h2>
      </div>

      <div className='container flex-col gap-[24px]'>
        <div className='container flex-col gap-[16px]'>
            <h3 className='mx-auto'>Reset password</h3>
            <h4 className='text-sm mx-auto text-center max-w-[360px]'>Enter your email and we will send instructions to reset your password </h4>
        </div>

        {
            !login && 
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header' >Email*</h4>
                    <input type='text' onChange={e => HandleEmail(e.target.value)}/>
                </div>
                <button onClick={() => HandleLogin()}>Log in</button>
                <button onClick={() => {navigate('/')}} className='secondary flex justify-center '>
                    <div className='flex gap-[12px]'><img src={ArrowLogo} className='my-auto'/><span>Back to Login</span></div>
                </button>
            </div>
        }

        {
            login &&
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header'>Code from email*</h4>
                    <input type='text' onChange={(e) => HandleCode(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>New password*</h4>
                    <input type='password' onChange={(e) => HandleNewPassword(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Repeat password*</h4>
                    <input type='password' onChange={(e) => HandleRepeatPassword(e.target.value)}/>
                </div>
                <button onClick={() => {navigate(`/main/?page=home&role=${role}`)}}>Log in</button>
                <button onClick={() => {navigate('/')}} className='secondary flex justify-center '>
                    <div className='flex gap-[12px]'><img src={ArrowLogo} className='my-auto'/><span>Back to Login</span></div>
                </button>
            </div>
        }

      </div>
    </div>
  </div>
  )
}

export default Reset