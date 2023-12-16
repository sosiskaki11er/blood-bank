import React from 'react'
import BannerBG from '../assets/img/banner-illustration.png'

function Banner() {
  return (
    <div className='banner'>
        <div className='container flex-col gap-[16px]'>
            <h2 className='text-bold'>Blood donation:<br/>A gift that keeps giving</h2>
            <h4 className='text-sm'>Donate blood and help save lives</h4>
            <img src={BannerBG} className='banner-bg'/>
        </div>
    </div>
  )
}

export default Banner