import {useNavigate} from 'react-router-dom'
import React, { useState } from 'react'
import BloodImg from '../assets/img/svg.png'
import HeartLogo from '../assets/icons/activity-heart.svg'


function Auth() {
    const [role,setRole] = useState('')
    const [roled,setRoled] = useState(false)
    const [signedUp, setSignedUp] = useState()
    const [auth, setAuth] = useState('')
    const [login, setLogin] = useState('')
    const [password, setPassword] = useState('')
    const [confirmPassword, setConfirmPassword] = useState('')
    const [firstName, setFirstName] = useState('')
    const [secondName, setSecondName] = useState('')
    const [address, setAddress] = useState('')
    const [date, setDate] = useState('')
    const [email, setEmail] = useState('')
    const [phone, setPhone] = useState('')
    const [bloodType, setBloodType] = useState('')
    const [rhesus,setRhesus] = useState('')
    const [donationType,setDonationType] = useState('')
    const [diseases, setDiseases] = useState('')
    const [doctorName, setDoctorName] = useState('')
    const [doctorID, setDoctorID] = useState('')
    const navigate = useNavigate()

    const HandleLogin = (login) => {
        setLogin(login)
    }

    const HandlePassword = (password) => {
        setPassword(password)
    }

    const HandleConfirmPassword = (password) => {
        setConfirmPassword(password)
    }

    const HandleForm = () => {
        setSignedUp(true)
    }

    const HandleFirstName = (name) => {
        setFirstName(name)
    }

    const HandleSecondName = (name) => {
        setSecondName(name)
    }

    const HandleDateOfBirth = (name) => {
        setDate(name)
    }

    const HandlePhone = (phone) => {
        setPhone(phone)
    }

    const HandleAddress = (address) => {
        setAddress(address)
    }

    const HandleEmail = (email) => {
        setEmail(email)
    }

    const HandleRole = (role) => {
        setRole(role)
    }

    const HandleDonationType = (type) => {
        setDonationType(type)
    }

    const HandleRhesus = (type) => {
        setRhesus(type)
    }

    const HandleDiseases = (diseases) => {
        setDiseases(diseases)
    }

    const HandleBloodType = (type) => {
        setBloodType(type)
    }

    const HandleDoctorName = (name) => {
        setDoctorName(name)
    }

    const HandleDoctorID = (ID) => {
        setDoctorID(ID)
    }

    const HandleRoled = () => {
        if(role){
            setRoled(true)
        }
    }
  return (
    <div className="container">
      <img src={BloodImg} alt='bg' className='h-screen'/>

      <div className="container flex-col gap-[40px] m-auto max-w-[420px] py-[80px] flex-grow-[1]">
        <div className='container flex-col gap-[24px]'>
          <div className="container gap-[16px] mx-auto">
            <img src={HeartLogo} alt="logo"/>
            <h1>BloodCare</h1>
          </div>
          <h2 className='max-w-[400px] text-center'>Connecting donors and recipients, saving lives.</h2>
        </div>

        {
            !roled &&
            <>
                <div className='container flex-col gap-[16px]'>
                    <h3 className='text-grey-600'>Choose account type:</h3>
                    <div className="container gap-[8px] flex-wrap">
                        <div className={role === "Donor" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleRole('Donor')}>Donor</div>
                        <div className={role === "Patient" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleRole('Patient')}>Patient</div>
                        <div className={role === "H. Staff" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('H. Staff')}>H. Staff</div>
                        <div className={role === "Doctor" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('Doctor')}>Doctor</div>
                        <div className={role === "Admin" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('Admin')}>Admin</div>
                    </div>
                </div>

                <button onClick={(e) => HandleRoled()}>Continue</button>
            </>
        }

        {
            !auth && roled  && 
            <div className='container flex-col gap-[12px]'>
                <button onClick={() => setAuth('login')}>Log in</button>
                {role !== 'Admin' && <button onClick={() => setAuth('signup')} className='secondary'>Sign up</button>}
            </div>
        }
        
        {
            (auth === 'login') && 
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header' >Login*</h4>
                    <input type='text' onChange={(e) => HandleLogin(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
                </div>
                <button onClick={() => {navigate(`/main/?page=home&role=${role}`)}}>Log in</button>
                {role !== 'Admin' &&
                <div className='flex mx-auto text-sm flex-col gap-[4px] leading-[48px]'>
                    <div className='flex gap-[6px]'>
                        <span className='text-grey-700'>Don’t have an account?</span>
                        <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('signup')}>Sign up</span>
                    </div>
                    <a className='text-red-600 underline cursor-pointer mx-auto' onClick={() => {navigate(`/reset/?role=${role}`)}}>Forgot password</a>
                    
                </div>
                }
            </div>
        }
        
        {
            (auth === 'signup') && !signedUp &&
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>First Name*</h4>
                        <input type='text' onChange={(e) => HandleFirstName(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Second Name*</h4>
                        <input type='text' onChange={(e) => HandleSecondName(e.target.value)}/>
                    </div>
                </div>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Date of birth*</h4>
                        <input type='date' onChange={(e) => HandleDateOfBirth(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Phone number</h4>
                        <input type='text' onChange={(e) => HandlePhone(e.target.value)}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Email</h4>
                    <input type='text' onChange={(e) => HandleEmail(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text' onChange={(e) => HandleAddress(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Confirm password*</h4>
                    <input type='password' onChange={(e) => HandleConfirmPassword(e.target.value)}/>
                </div>
                <button onClick={() => HandleForm()}>Sign up</button>
                <div className='flex mx-auto text-sm gap-[6px]'>
                    <span className='text-grey-700'>Already have an account?</span>
                    <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('login')}>Log in</span>
                </div>
            </div>
        }

        {
            signedUp && (role === 'Donor') &&
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select onChange={(e) => HandleBloodType(e.target.value)}>
                            <option>A</option>
                            <option>B</option>
                            <option>O</option>
                            <option>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select onChange={(e) => HandleRhesus(e.target.value)}>
                            <option>+</option>
                            <option>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' onChange={(e) => HandleDiseases(e.target.value)}/>
                </div>
                <div className='container flex-col gap-[16px]'>
                    <h4 className='input-header'>Choose donation type:</h4>
                    <div className="container gap-[8px] flex-wrap">
                        <div className={donationType === "Charity" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType('Charity')}>Charity</div>
                        <div className={donationType === "Paid" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType('Paid')}>Paid</div>
                    </div>
                </div>
                <button onClick={() => {navigate(`/main/?page=home&role=${role}`)}}>Continue</button>
            </div>
        }

        {
            signedUp && (role === 'Patient') &&
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col max-w-[195px]'>
                        <h4 className='input-header'>Doctor’s name</h4>
                        <input type='text' onChange={(e) => HandleDoctorName(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px]'>
                        <h4 className='input-header'>Doctor’s ID</h4>
                        <input type='text' onChange={(e) => HandleDoctorID(e.target.value)}/>
                    </div>
                </div>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col max-w-[195px]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select className='w-[200px]' onChange={(e) => HandleBloodType(e.target.value)}>
                            <option>A</option>
                            <option>B</option>
                            <option>O</option>
                            <option>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col max-w-[195px]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select className='w-[200px]' onChange={(e) => HandleRhesus(e.target.value)}>
                            <option>+</option>
                            <option>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' onChange={(e) => HandleDiseases(e.target.value)}/>
                </div>
                <button onClick={() => {navigate(`/main/?page=home&role=${role}`)}}>Continue</button>
            </div>
        }

        {
            signedUp && (role === 'H. Staff' || role === 'Doctor') &&
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header'>Select your hospital</h4>
                    <select type='text' onChange={(e) => HandleDiseases(e.target.value)}>
                        <option>DoctorMim</option>
                    </select>
                </div>
                <button onClick={() => {navigate(`/main/?page=home&role=${role}`)}}>Continue</button>
            </div>
        }
      </div>
    </div>
  )
}

export default Auth